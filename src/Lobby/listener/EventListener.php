<?php

namespace Lobby\listener;

use Lobby\session\SessionFactory;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $session = SessionFactory::getSession($player = $event->getPlayer());
        $session->initScoreboard();
        $session->sendWelcomeMessages();
        $session->setup();
        $session->teleportToLobbyWorld();

        foreach(SessionFactory::getSessions() as $session) {
            $session->update();
        }
        # Welcome message
        $event->setJoinMessage("§7[§2+§7] " . $player->getName());
    }

    public function onQuit(PlayerQuitEvent $event): void {
        # Leave message
        $event->setQuitMessage("§7[§c-§7] " . $event->getPlayer()->getName());
    }

    public function onExhaust(PlayerExhaustEvent $event): void {
        # Cancel hunger update
        $event->cancel();
    }

    public function onDamage(EntityDamageEvent $event): void {
        # Cancel fall damage
        if($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->cancel();
        }
    }

}

