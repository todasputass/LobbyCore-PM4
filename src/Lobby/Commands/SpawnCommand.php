<?php

declare(strict_types=1);

namespace Lobby\Commands;


use Lobby\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class SpawnCommand extends Command {

    public function __construct()
    {
        parent::__construct('spawn', 'Use it to teleport to the world spawn');
    }
    
    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$sender instanceof Player)
        return;

        if (!isset($args[0])) {
            $sender->teleport($sender->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
            return;
        }
    }
}
