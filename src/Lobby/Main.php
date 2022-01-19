<?php 

namespace Lobby;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener
{
    public function onEnable() : void {
        $this->GetServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->GetLogger()->info("LobbyCore Enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("config.yml");
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer(); 
        $player->sendTitle($this->getConfig()->get("Server-Name"));
    }
}

