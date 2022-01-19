<?php 

namespace Lobby;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase 
{

    public function onEnable() : void {
        $this->GetServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->GetLogger()->info("LobbyCore Enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->getConfig = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
        $player->getLevel()->sendSound(new GhastShootSound($player)); 
        $player->sendTitle($this->getConfig()->get("Server-Name");
    }
}

