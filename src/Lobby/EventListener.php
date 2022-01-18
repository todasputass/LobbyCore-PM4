<?php 

namespace Lobby;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\entity\Location;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $event) : void
    {
        $player = $event->getPlayer();
        $player->getInventory()->setItem(4, ItemFactory::getInstance()->get(ItemIds::NAME_TAG)->setCustomName("§l§r§6Servers"));
        $event->setJoinMessage("§7[§2+§7] " . $player->getName());
        $player->sendTitle("§l§6Welcome");
        $player->sendSubTitle("§6Welcome " . $player->getName());
        $player->setGamemode(GameMode::ADVENTURE());
        $player->setHealth($player->getMaxHealth());
        $player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());
    }
                          
    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer();
        $event->setQuitMessage("§7[§c-§7] " . $player->getName());
    }
}