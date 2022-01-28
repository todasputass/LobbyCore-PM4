<?php

declare(strict_types=1);


namespace Lobby\item;


use Lobby\form\ServersForm;

use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class CosmeticsItem extends LobbyItem {

    public function __construct() {
        parent::__construct(new ItemIdentifier(ItemIds::CHEST, 0), "§r§6Cosmetics §r§7(Right Click)");
    }

    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult {
        $player->getServer()->dispatchCommand($player, "capes");
        return ItemUseResult::SUCCESS();
    }

}