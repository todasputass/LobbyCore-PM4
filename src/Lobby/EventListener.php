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

        switch ($name) {
            case "§l§r§6Servers":
                $player->sendForm(new ServersForm());
                break;
        }
    }

    public function onItemUse(PlayerItemUseEvent $event) : void {
        $player = $event->getPlayer();
        $name = $event->getItem()->getCustomName();
        if ($name) {
            switch ($name) {
                case "§l§r§6Servers":
                    $player->sendForm(new ServersForm());
                    break;
            }
        }
    }
}

