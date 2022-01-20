<?php 

namespace Lobby;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\SingletonTrait;
use Lobby\session\SessionFactory;

class Main extends PluginBase {
    use SingletonTrait;
    
    /** @var SessionFactory */
    private SessionFactory $sessionFactory;
    
    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable() : void {
        # Setup config
        $this->saveResource("config.yml");
        # Setup session factory
        $this->sessionFactory = new SessionFactory;
        # Add a Custom MOTD
        $this->getServer()->getNetwork()->setName($this->getConfig()->get("server-motd"));
        # Register task
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (int $currentTick): void {
            foreach ($this->getSessionFactory()->getSessions() as $session)
                $session->update();
        }), 1);
        # Register event handler
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        
        # Logger
        $this->getLogger()->info("LobbyCore Enabled");
    }
    
    /**
     * @return SessionFactory
     */
    public function getSessionFactory(): SessionFactory
    {
        return $this->sessionFactory;
    }
}

