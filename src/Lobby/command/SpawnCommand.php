<?php

declare(strict_types=1);

namespace Lobby\command;


use Lobby\Main;
use Lobby\session\SessionFactory;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class SpawnCommand extends Command {

    public function __construct() {
        parent::__construct('spawn', 'Use it to teleport to the world spawn');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($sender instanceof Player and isset($args[0])) {
            SessionFactory::getSession($sender)->teleportToLobbyWorld();
        }
    }

}
