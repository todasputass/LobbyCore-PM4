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
                    $color = new Color(168, 50, 50);
                    break;
                
                case 1:
                    $color = new Color(168, 64, 50);
                    break;
                
                case 2:
                    $color = new Color(168, 74, 50);
                    break;
               
               case 3:
                   $color = new Color(168, 85, 50);
                   break;
               
               case 4:
                   $color = new Color(168, 97, 50);
                   break;
                   
               case 5:
                   $color = new Color(168, 107, 50);
                   break;
               
               case 6:
                   $color = new Color(168, 119, 50);
                   break;
               
               case 7:
                   $color = new Color(168, 133, 50);
                   break;
               
               case 8:
                   $color = new Color(168, 148, 50);
                   break;
               
               case 9:
                   $color = new Color(168, 162, 50);
                   break;
                
               case 10:
                   $color = new Color(164, 168, 50);
                   break; 
               
               case 11:
                    $color = new Color(150, 168, 50);
                    break;

               case 12:
                   $color = new Color(135, 168, 50);
                   break;
               
               case 13:
                   $color = new Color(121, 168, 50);
                   break;
               
               case 14:
                   $color = new Color(103, 168, 50);
                   break;
               
               case 15:
                   $color = new Color(85, 168, 50);
                   break;
               
               case 16:
                   $color = new Color(64, 168, 50);
                   break;
                
               case 17:
                   $color = new Color(50, 168, 52);
                   break; 
               
               case 18:
                    $color = new Color(50, 168, 68);
                    break;
                    
                case 19:
                    $color = new Color(50, 168, 83);
                    break;
                
                case 20:
                    $color = new Color(50, 168, 109);
                    break;
                
                case 21:
                    $color = new Color(50, 168, 125);
                    break;
               
               case 22:
                   $color = new Color(50, 168, 146);
                   break;
               
               case 23:
                   $color = new Color(50, 168, 164);
                   break;
                   
               case 24:
                   $color = new Color(50, 148, 168);
                   break;
               
               case 25:
                   $color = new Color(50, 133, 168);
                   break;
               
               case 26:
                   $color = new Color(50, 115, 168);
                   break;
               
               case 28:
                   $color = new Color(50, 99, 168);
                   break;
               
               case 29:
                   $color = new Color(50, 80, 168);
                   break;
                
               case 30:
                   $color = new Color(50, 64, 168);
                   break; 
               
               case 31:
                    $color = new Color(52, 50, 168);
                    break;

               case 32:
                   $color = new Color(74, 50, 168);
                   break;
               
               case 33:
                   $color = new Color(101, 50, 168);
                   break;
               
               case 34:
                   $color = new Color(121, 50, 168);
                   break;
               
               case 35:
                   $color = new Color(140, 50, 168);
                   break;
               
               case 36:
                   $color = new Color(156, 50, 168);
                   break;
                
               case 37:
                   $color = new Color(168, 50, 158);
                   break; 
               
               case 38:
                    $color = new Color(168, 50, 140);
                    break;

               case 39:
                    $color = new Color(168, 50, 121);
                    break;

               case 40:
                   $color = new Color(168, 50, 99);
                   break;
               
               case 41:
                   $color = new Color(168, 50, 81);
                   break;
               
               case 42:
                   $color = new Color(168, 50, 62);
                   break;
               
               case 43:
                   $color = new Color(168, 50, 50);
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