<?php

declare(strict_types=1);

namespace Lobby\command;

use Lobby\entity\NPCEntity;
use Lobby\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class NPCCommand extends Command{

    public function __construct() {
        parent::__construct('npc', 'Use this command to place the NPCs of your server as you have created them in the config.yml');
        $this->setPermission('npc.lobbycore');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player)
            return;
        
        if (!isset($args[0])) {
            $sender->sendMessage(TextFormat::colorize('§r§cUse /npc add (server-name)'));
            return;
        }
        
        switch (strtolower($args[0])) {
            case 'add':
                if (!isset($args[0])) {
                    $sender->sendMessage(TextFormat::colorize('§r§cYou need to put the name of the Server that you defined in the config'));
                    return;
                }
                $servers = Main::getInstance()->getConfig()->get('servers.available');
                
                if (!isset($servers[$args[1]])) {
                    $sender->sendMessage(TextFormat::colorize('§r§cServer Not Found'));
                    return;
                }
                $entity = NPCEntity::create($sender, $args[1])
                $entity->spawnToAll();
                $sender->sendMessage(TextFormat::colorize('§r§aNPC created successfully'));
                break;
        }
    }
}