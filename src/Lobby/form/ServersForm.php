<?php

namespace Lobby\form;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use Lobby\Main;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;


class ServersForm extends SimpleForm
{

    public function __construct()
    {
        parent::__construct("§r§7» §l§6Server Selector §r§7«", "§r§7Select the server you want to transfer to");
        $servers = Main::getInstance()->getConfig()->get('servers.available');

        foreach ($servers as $server) {
            $this->addButton(new Button(TextFormat::colorize("&6" . $server["name"] . "\n&fClick to join")), function (Player $player, int $index) use ($server): void {
                $address = explode(":", $server["address"]);
                $player->transfer($address[0], (int)$address[1], "Transfer to {$server["name"]}");
            });
        }
    }

}
