<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace Lobby\item;


use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class LobbyItem extends Item {

    public function __construct(ItemIdentifier $identifier, string $name) {
        $this->setCustomName($name);
        parent::__construct($identifier, $name);
        $this->getNamedTag()->setByte("lobby", 1);
    }

}