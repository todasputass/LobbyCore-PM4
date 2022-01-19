<?php 

namespace Lobby;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

public function onEnable() : void 
{

$this->GetServer()->getPluginManager()->registerEvents(new EventListener(), $this);
$this->GetLogger()->info("LobbyCore Enabled");

$this->saveDefaultConfig();
    $this->getConfig()->get("Server-Name");
    $this->getConfig()->get("Join-Title");
}



}
