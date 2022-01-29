<?php

declare(strict_types=1);

namespace Lobby\command;

use Lobby\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\player\GameMode;

class GamemodeCommand extends Command{

    public function __construct() {
        parent::__construct('gm', 'Use this command to change your game mode');
        $this->setPermission('gm.lobby');
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$this->testPermission($sender)) return;
        if (!$sender instanceof Player)
            return;
        
        if (!isset($args[0])) {
            $sender->sendMessage(TextFormat::colorize('§r§cUse /gm (0|1|2|3])'));
            return;
        }
        
        switch (strtolower($args[0])) {
            case '0':
                if (!isset($args[1])) {
                    $sender->setGamemode(GameMode::SURVIVAL());
                    $sender->sendMessage(TextFormat::colorize('§r§cYou changed your game mode to §6Survival'));
                    return;
                }
            case '1':
                if (!isset($args[1])) {
                    $sender->setGamemode(GameMode::CREATIVE());
                    $sender->sendMessage(TextFormat::colorize('§r§cYou changed your game mode to §6Creative'));
                    return;
                }
            case '2':
                if (!isset($args[1])) {
                    $sender->setGamemode(GameMode::ADVENTURE());
                    $sender->sendMessage(TextFormat::colorize('§r§cYou changed your game mode to §6Adventure'));
                    return;
                }
            case '3':
                if (!isset($args[1])) {
                    $sender->setGamemode(GameMode::SPECTATOR());
                    $sender->sendMessage(TextFormat::colorize('§r§cYou changed your game mode to §6Spectator'));
                    return;
            }
        }
    }
}

