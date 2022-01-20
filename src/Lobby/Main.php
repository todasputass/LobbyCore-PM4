<?php 

namespace Lobby;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\event\Listener;
use pocketmine\utils\SingletonTrait;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\entity\EntityDamageEvent;
use Lobby\session\SessionFactory;

class Main extends PluginBase implements Listener {
    use SingletonTrait;
    
    /** @var SessionFactory */
    private SessionFactory $sessionFactory;
    
    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable() : void {
        $this->sessionFactory = new SessionFactory;
        $this->GetServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->GetLogger()->info("LobbyCore Enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("config.yml");
    }
    
    /**
     * @return SessionFactory
     */
    public function getSessionFactory(): SessionFactory
    {
        return $this->sessionFactory;
    }
}

