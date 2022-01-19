<?php

namespace Lobby\Cancel;

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