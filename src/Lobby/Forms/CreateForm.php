<?php

namespace Lobby\Forms;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use jojoe77777\FormAPI\entries\simple\Button;

class CreateForm extends SimpleForm {

    public function __construct() {

        if($inviter instanceof Player) {

            parent::construc("Servers");
            $this->addButton(new Button ('HCF'));
        }
    }
}

