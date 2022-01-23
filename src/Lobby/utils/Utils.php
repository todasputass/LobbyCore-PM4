<?php

declare(strict_types=1);

namespace Lobby\utils;

use pocketmine\Server;

final class Utils {

    /**
     * @return int
     */
    static public function getNetworkPlayers() : int {
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
    static public function getNetworkMaxPlayers() : int {
        $players = Server::getInstance()->getMaxPlayers();
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("Servers");
        
        if ($plugin !== null) {
            foreach ($plugin->getAllServers() as $server)
                $players += $server->getMaxPlayers();
        }
        return $players;
    }
}
