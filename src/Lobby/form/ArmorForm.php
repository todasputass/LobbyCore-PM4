<?php

namespace Lobby\form;

use Lobby\Main;
use Lobby\form\ArmorForms\HelmetForm;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use cosmicpe\form\types\Icon;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;


class ArmorForm extends SimpleForm {
    
    public function __construct() {
		parent::__construct("§r§7» §l§6Armor §r§7«", "§r§7Select a armor");
		$this->addButton(new Button("§6Helmet\n§r§7Click to change"), function(Player $player, int $index) {
			$player->sendForm(new HelmetForm());
		});
		$this->addButton(new Button("§6Chestplate\n§r§7Click to change"), function(Player $player, int $index) {
			$player->getServer()->dispatchCommand($player, "capes");
		});
        $this->addButton(new Button("§6Leggings\n§r§7Click to change"), function(Player $player, int $index) {
			$player->getServer()->dispatchCommand($player, "fly");
		});
		$this->addButton(new Button("§6Boots\n§r§7Click to change"), function(Player $player, int $index) {
			$player->getServer()->dispatchCommand($player, "fly");
		});
	}
}


