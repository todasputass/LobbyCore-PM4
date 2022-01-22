<?php 

namespace Lobby;

use Lobby\command\SpawnCommand;
use Lobby\command\NPCCommand;
use Lobby\listener\EventListener;
use Lobby\listener\ItemListener;
use Lobby\listener\SessionListener;
use Lobby\session\SessionFactory;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase {
    use SingletonTrait;
    
    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable(): void {
        $server = $this->getServer();
        # Setup config
        $this->saveResource("config.yml");
        # Add a Custom MOTD
        $this->getServer()->getNetwork()->setName($this->getConfig()->get("server-motd"));
        # Register commands
        $server->getCommandMap()->register('spawn', new SpawnCommand());
        $server->getCommandMap()->register('npc', new NPCCommand());

        # Register events
        $this->registerListener(new EventListener());
        $this->registerListener(new ItemListener());
        $this->registerListener(new SessionListener());

        # Setup task
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            foreach (SessionFactory::getSessions() as $session)
                $session->update();
        }), 1);
        
        # Send message to the logger
        $this->getLogger()->info("LobbyCore Enabled");
    }

    private function registerListener(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }

}

