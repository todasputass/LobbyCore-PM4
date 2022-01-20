<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

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