<?php

namespace Lobby\Cancel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\entity\EntityDamageEvent;

class CancelEvents implements Listener {

    public function onExhaust(PlayerExhaustEvent $event): void {
        $event->setCancelled(true);
    }

    public function onDamage((EntityDamageEvent $event) {
        if($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->setCancelled(true);
        }
    }
}
