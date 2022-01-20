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
        parent::__construct("Server Selector", "Choose a option");
        $servers = Main::getInstance()->getConfig()->get('servers.available');

        foreach ($servers as $server) { 
            $this->addButton(new Button($server["server"] . "\nClick to join"), function(Player $player, int $index) use ($server) : void {
                $address = explode(":", $server["address"]); # el explode convierte la string en array, dividiendose por ":"
                $player->transfer($address[0], (int) $address[1], "Transfer to {$server["server"]}"); # Aqui sacamos la array 0 la cual contiene la IP ya que esta en el primer parametro
            });
        }
    }
}
