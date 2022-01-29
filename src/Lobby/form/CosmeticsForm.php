<?php

namespace Lobby\form;

use Lobby\Main;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use cosmicpe\form\types\Icon;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;


class CosmeticsForm extends SimpleForm {
    
    public function __construct() {
		parent::__construct("§r§7» §l§6Cosmetics §r§7«", "§r§7Select a cosmetic");
		$this->addButton(new Button("§6RainbowArmor\n§r§7Click to activate or deactivate the Rainbow armor"), function(Player $player, int $index) {
			$player->getServer()->dispatchCommand($player, "cfa");
		});
		$this->addButton(new Button("§6Cape\n§r§7Click to activate or deactivate a cape"), function(Player $player, int $index) {
			$player->getServer()->dispatchCommand($player, "capes");
		});
        $this->addButton(new Button("§6Fly\n§r§7Click to activate or deactivate the fly"), function(Player $player, int $index) {
			$player->getServer()->dispatchCommand($player, "fly");
		});
	}
}
