<?php

namespace Lobby\form;

use Lobby\Main;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use cosmicpe\form\types\Icon;

use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;


class ServersForm extends SimpleForm {
    
    public function __construct() {
        parent::__construct("§r§7» §l§6Server Selector §r§7«", "§r§7Select the server you want to transfer to");
        $servers = Main::getInstance()->getConfig()->get('servers.available');

        foreach($servers as $server) {
            $this->addButton(new Button($server["server"] . "\nClick to join"), function(Player $player, int $index) use ($server) : void {
                $address = explode(":", $server["address"]); # el explode convierte la string en array, dividiendose por ":"
                $player->transfer($address[0], (int) $address[1], "Transfer to {$server["server"]}"); # Aqui sacamos la array 0 la cual contiene la IP ya que esta en el primer parametro
            });
        }
    }

}
