<?php

namespace Lobby;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\GameMode;
use Lobby\Forms\ServersForm;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();

        # Setup session
        Main::getInstance()->getSessionFactory()->createSession($player);
        # Setup player
        $player->setGamemode(GameMode::ADVENTURE());
        $player->setHealth($player->getMaxHealth());
        $player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());
        $player->getInventory()->setItem(4, ItemFactory::getInstance()->get(ItemIds::COMPASS)->setCustomName("§l§r§6Servers"));
        # Welcome title
        $player->sendTitle(Main::getInstance()->getConfig()->get("Server-Name"));
        $player->teleport($this->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        $player->sendSubTitle("§6Welcome " . $player->getName());
        # Welcome message
        $event->setJoinMessage("§7[§2+§7] " . $player->getName());
    }

    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer();

        # Remove session
        Main::getInstance()->getSessionFactory()->removeSession($player);
        # Leave message
        $event->setQuitMessage("§7[§c-§7] " . $player->getName());
    }

    public function onInteract(PlayerInteractEvent $event) : void {
        $player = $event->getPlayer();
        $name = $event->getItem()->getCustomName();

        #
        switch ($name) {
            case "§l§r§6Servers":
                $player->sendForm(new ServersForm());
                break;
        }
    }

    public function onItemUsePlayerItemUseEvent $event) : void {
        $player = $event->getPlayer();
        $name = $event->getItem()->getCustomName();

        #
        switch ($name) {
            case "§l§r§6Servers":
                $player->sendForm(new ServersForm());
                break;
        }
    }

    public function onExhaust(PlayerExhaustEvent $event) : void {
        # Cancel hunger update
        $event->cancel();
    }

    public function onDamage(EntityDamageEvent $event : void {
        # Cancel fall damage
        if($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->cancel();
        }
    }
}

