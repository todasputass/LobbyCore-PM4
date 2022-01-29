<?php

declare(strict_types=1);

namespace Lobby\utils;

use pocketmine\color\Color;
use pocketmine\player\Player;
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
    
    /**
     * @param Player $player
     * @return string
     */
    static public function getRank(Player $player): string {
        $rank = null;
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("GreekRanks");

        if ($plugin !== null) {
            $rankManager = $plugin->ranksManager;
            $player = $rankManager->getPlayerByXuid($player->getXuid());
            
            if ($player !== null && $player->isValid()) {
                if ($player->getMainRank() !== null && $player->getMainRank()->getId() !== 0)
                    $rank = $player->getMainRank()->getFormat();
                
                if ($player->getRank() !== null) {
                    if ($rank === null)
                        $rank = $player->getRank()->getFormat();
                    else $rank .= ' ' . $player->getRank()->getFormat();
                }
            }
        }
        return $rank ?? '§6Default';
    }
    
    /**
     * @param Player $player
     */
    static public function randomArmorColor(Player $player): void {
        if (($helmet = $player->getArmorInventory()->getHelmet())->getId() === 298 &&
            ($chestplate = $player->getArmorInventory()->getChestplate())->getId() === 299 &&
            ($leggings = $player->getArmorInventory()->getLeggings())->getId() === 300 &&
            ($boots = $player->getArmorInventory()->getBoots())->getId() === 301) {
            $number = mt_rand(0, 9);
            $color = new Color(255, 255, 255);
            
            switch ($number) {
                case 0:
                    $color = new Color(255, 255, 0);
                    break;
                
                case 1:
                    $color = new Color(255, 0, 0);
                    break;
                
                case 2:
                    $color = new Color(0, 255, 0);
                    break;
               
               case 3:
                   $color = new Color(0, 255, 255);
                   break;
               
               case 4:
                   $color = new Color(0, 0, 255);
                   break;
                   
               case 5:
                   $color = new Color(255, 0, 255);
                   break;
               
               case 6:
                   $color = new Color(0, 0, 0);
                   break;
               
               case 7:
                   $color = new Color(150, 235, 0);
                   break;
               
               case 8:
                   $color = new Color(128, 0, 255);
                   break;
               
               case 9:
                   $color = new Color(255, 255, 255);
                   break;
            }
            $player->getArmorInventory()->setContents([
                $helmet->setCustomColor($color),
                $chestplate->setCustomColor($color),
                $leggings->setCustomColor($color),
                $boots->setCustomColor($color)
            ]);
        }
    }
}