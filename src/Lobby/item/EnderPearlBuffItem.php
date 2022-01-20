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
        parent::__construct(new ItemIdentifier(ItemIds::ENDER_PEARL, 0), "§l§6EnderPearl Buff");
    }

    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult {
        $player->setMotion($player->getDirectionVector()->multiply(0.3)->add(0, $player->getEyeHeight(), 0));
        return ItemUseResult::SUCCESS();
    }

}