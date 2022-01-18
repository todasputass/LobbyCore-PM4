<?php 

namespace Lobby;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $event) : void
    {
        $player = $event->getPlayer();
        $event->setJoinMessage("§7[§2+§7] " . $player->getName());
    }
    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer();
        $event->setQuitMessage("§7[§c-§7] " . $player->getName());
    }
}