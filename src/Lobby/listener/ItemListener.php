<?php

declare(strict_types=1);


namespace Lobby\listener;


use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;

class ItemListener implements Listener {

    public function onTransaction(InventoryTransactionEvent $event): void {
        foreach($event->getTransaction()->getActions() as $action) {
            if($action->getSourceItem()->getNamedTag()->getTag("lobby") !== null) {
                $event->cancel();
            }
        }
    }
}