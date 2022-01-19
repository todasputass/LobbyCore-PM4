<?php

namespace Lobby\Forms;

use pocketmine\player\Player;
use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use cosmicpe\form\types\Icon;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use Lobby\Main;

class ServersForm extends SimpleForm {

	public function __construct() {
		parent::__construct("Servers Selector", "Choose a option");
		$this->addButton(new Button("HCF\nClick Me!"), function(Player $player, int $index) {
			$data = Main::getInstance()->getConfig()->get('servers')['server1'];
			$player->transfer($data['ip'], (int) $data['port']);

		});
		$this->addButton(new Button("Practice\nClick Me!"), function(Player $player, int $index) {
			$data = Main::getInstance()->getConfig()->get('servers')['server2'];
			$player->transfer($data['ip'], (int) $data['port']);
		});
	}

}

