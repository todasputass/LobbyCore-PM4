<?php

declare(strict_types=1);


namespace Lobby\item;


use Lobby\form\ServersForm;

use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class ServerSelectorItem extends LobbyItem {

    public function __construct() {
        parent::__construct(new ItemIdentifier(ItemIds::COMPASS, 0), "§r§7» §l§6Server Selector §r§7«");
    }

    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult {
        $player->sendForm(new ServersForm());
        return ItemUseResult::SUCCESS();
    }

}