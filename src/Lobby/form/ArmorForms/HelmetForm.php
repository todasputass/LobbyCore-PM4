<?php

namespace Lobby\form\ArmorsForms;

use Lobby\Main;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use cosmicpe\form\types\Icon;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\world\sound\EndermanTeleportSound;


class HelmetForm extends SimpleForm {
    
    public function __construct() {
		parent::__construct("§r§7» §l§6Helmet Color §r§7«", "§r§7Select a color");
		$this->addButton(new Button("§6Red\n§r§7Click to change"), function(Player $player, int $index) {
            $helmet = VanillaItems::LEATHER_CAP();
            $helmet->setCustomColor(new Color(255,114,118); #red
            $this->player->getArmorInventory()->setHelmet($helmet);
		});
	}
}
