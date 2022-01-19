<?php

namespace Lobby\Forms;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use jojoe77777\FormAPI\entries\simple\Button;

class CreateForm extends SimpleForm {

    public function __construct(Player $inviter, Player $reciver, string $mode) {

        if($inviter instanceof Player) {

            $name=$inviter->getName();
            parent::construc("Servers");
            $this->addButton(new Button ("HCF"));
        }
    }
}

