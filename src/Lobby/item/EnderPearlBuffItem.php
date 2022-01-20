<?php

declare(strict_types=1);


namespace Lobby\item;


use Lobby\form\ServersForm;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class EnderPearlBuffItem extends LobbyItem {

    public function __construct() {
        parent::__construct(new ItemIdentifier(ItemIds::ENDER_PEARL, 0), "§r§7» §r§l§6EnderPearl Buff §r§7«");
    }

    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult {
        $player->setMotion($player->getDirectionVector()->multiply(1.6));
        $player->getInventory()->setItem(0, $this);
        return ItemUseResult::FAIL();
    }

}