<?php

namespace Lobby\form\ArmorsForms;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use pocketmine\color\Color;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;


class HelmetForm extends SimpleForm
{

    public function __construct()
    {
        parent::__construct("§r§7» §l§6Helmet Color §r§7«", "§r§7Select a color");
        $this->addButton(new Button("§6Red\n§r§7Click to change"), function (Player $player, int $index) {
            $helmet = VanillaItems::LEATHER_CAP();
            $helmet->setCustomColor(new Color(255, 114, 118)); #red
            $player->getArmorInventory()->setHelmet($helmet);
        });
    }
}
