<?php

declare(strict_types=1);

namespace Lobby\entity;

use juqn\lobbycore\LobbyCore;
use pocketmine\entity\Human;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\network\mcpe\protocol\TransferPacket;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class NPCEntity extends Human
{
    
    /**
     * @param Player $player
     * @param int $server
     */
    public static function create(Player $player, int $server): self
    {
        $nbt = CompoundTag::create()
			->setTag("Pos", new ListTag([
				new DoubleTag($player->getLocation()->x),
				new DoubleTag($player->getLocation()->y),
				new DoubleTag($player->getLocation()->z)
			]))
			->setTag("Motion", new ListTag([
				new DoubleTag($player->getMotion()->x),
				new DoubleTag($player->getMotion()->y),
				new DoubleTag($player->getMotion()->z)
			]))
			->setTag("Rotation", new ListTag([
				new FloatTag($player->getLocation()->yaw),
				new FloatTag($player->getLocation()->pitch)
			]));
        $nbt->setInt('server', $serverId);
        $entity = new self($player->getLocation(), $player->getSkin(), $nbt);
        return $entity;
    }
    
    /** @var int|null */
    private ?int $serverId = null;
    
    /**
     * @return CompoundTag
     */
    public function saveNBT(): CompoundTag
    {
        $nbt = parent::saveNBT();
        
        if ($this->serverId !== null)
            $nbt->setInt('server', $this->serverId);
        return $nbt;
    }
    /**
     * @param CompoundTag $nbt
     */
    protected function initEntity(CompoundTag $nbt): void
    {
        parent::initEntity($nbt);
        
        if ($nbt->getTag('server') === null) {
            $this->flagForDespawn();
            return;
        }
        $this->serverId = $nbt->getInt('server');
        $this->setNameTagAlwaysVisible(true);
        $this->setImmobile(true);
    }
    
    /**
     * @param int $currentTick
     * @return bool
     */
    public function onUpdate(int $currentTick): bool
    {
        $parent = parent::onUpdate($currentTick);
        
         if ($this->serverId !== null) {
            $data = Main::getInstance()->getConfig()->get('servers.available')[$this->serverId];
            $this->setNameTag(TextFormat::colorize($data['server']));
        } else $this->setNameTag(TextFormat::colorize('&cERROR'));
        return $parent;
    }
    
    /**
     * @param EntityDamageEvent $source
     */
    public function attack(EntityDamageEvent $source): void
    {
        $source->cancel();
        
        if ($source instanceof EntityDamageByEntityEvent) {
            $damager = $source->getDamager();
            
            if (!$damager instanceof Player) return;
            
            if ($damager->getInventory()->getItemInHand()->getId() === 276 && $damager->hasPermission('removenpc.lobby')) {
                $this->kill();
                return;
            }
            $servers = Main::getInstance()->getConfig()->get('servers.available');
            
            if (!isset($servers[$this->serverId])) return;
            $data = $servers[$this->serverId];

            $address = explode(":", $data["address"]);
            $damager->transfer($address[0], (int) $address[1], "Transfer to {$server["name"]}");
            
            $damager->getNetworkSession()->sendDataPacket($pk);
        }
    }
}
