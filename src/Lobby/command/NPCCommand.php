<?php

declare(strict_types=1);

namespace Lobby\command;

use Lobby\entity\NPCEntity;
use Lobby\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class NPCCommand extends Command
{

    public function __construct()
    {
        parent::__construct('npc', 'Use this command to place the NPCs of your server as you have created them in the config.yml');
        $this->setPermission('npc.lobby');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$this->testPermission($sender)) {
            return;
        }
        if (!$sender instanceof Player) {
            return;
        }

        if (!isset($args[0])) {
            $sender->sendMessage(TextFormat::colorize('§r§cUse /npc add (server-name)'));
            return;
        }

        if (strtolower($args[0]) === 'add') {
            if (!isset($args[1])) {
                $sender->sendMessage(TextFormat::colorize('§r§cYou need to put the name of the Server that you defined in the config'));
                return;
            }
            $servers = Main::getInstance()->getConfig()->get('servers.available');
            $serverId = null;

            foreach ($servers as $id => $data) {
                if (strtolower($args[1]) === strtolower($data["name"])) {
                    $serverId = $id;
                    break;
                }
            }

            if ($serverId === null) {
                $sender->sendMessage(TextFormat::colorize('§r§cServer Not Found'));
                return;
            }
            $entity = NPCEntity::create($sender, $serverId);
            $entity->spawnToAll();
            $sender->sendMessage(TextFormat::colorize('§r§aNPC created successfully'));
        }
    }
}
