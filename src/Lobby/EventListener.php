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
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        $player->getInventory()->setItem(4, ItemFactory::getInstance()->get(ItemIds::COMPASS)->setCustomName("§l§r§6Servers"));
        $event->setJoinMessage("§7[§2+§7] " . $player->getName());
        $player->sendSubTitle("§6Welcome " . $player->getName());
        $player->setGamemode(GameMode::ADVENTURE());
        $player->setHealth($player->getMaxHealth());
        $player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());



    }

    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer();
        $event->setQuitMessage("§7[§c-§7] " . $player->getName());
    }

    public function interact(PlayerInteractEvent $event) : void {
        $player = $event->getPlayer();
        $name = $event->getItem()->getCustomName();
        if ($name) {
            switch ($name) {
                case "§l§r§6Servers":
                    $player->sendMessage("Agregar Funcion que Abre UI");
                    break;
            }
        }
    }

    public function rightclick(PlayerItemUseEvent $event) : void {
        $player = $event->getPlayer();
        $name = $event->getItem()->getCustomName();
        if ($name) {
            switch ($name) {
                case "§l§r§6Servers":
                    $player->sendMessage("Agregar Funcion que Abre UI");
                    break;
            }
        }
    }
}