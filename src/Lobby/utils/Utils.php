<?php

declare(strict_types=1);

namespace Lobby\utils;

use pocketmine\Server;

final class Utils {

    /**
     * @return int
     */
    static public function getNetworkPlayers(): int {
        $players = count(Server::getInstance()->getOnlinePlayers());
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("Servers");
        
        if ($plugin !== null) {
            foreach ($plugin->getAllServers() as $server)
                $players += $server->getPlayers();
        }
        return $players;
    }

    /**
     * @return int
     */
    static public function getNetworkMaxPlayers(): int {
        $players = Server::getInstance()->getMaxPlayers();
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("Servers");
        
        if ($plugin !== null) {
            foreach ($plugin->getAllServers() as $server)
                $players += $server->getMaxPlayers();
        }
        return $players;
    }

    /**
     * @param string $name
     * @return int
     */
    static public function getServerPlayers(string $name): int {
        $players = 0;
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("Servers");
        
        if ($plugin !== null) {
            $server = $plugin->getServers($name); // TODO: The name of the function is that way so as not to interfere with getServer()
            
            if ($server !== null) $players = $server->getPlayers();
        }
        return $players;
    }
    public function getRank(): int {
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("GreekRanks");
        $player = $event->getPlayer
        if ($player) {
            $greekPlayer = Main::getInstance()->ranksManager->getPlayer($player);
            if ($greekPlayer->getInformation() !== []) {
                $rank = $greekPlayer->getRank() ? $greekPlayer->getRank()->getFormat()
                return;
            }
        }
    }
}

