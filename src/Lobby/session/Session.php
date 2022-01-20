<?php

declare(strict_types=1);

namespace Lobby\session;

use Lobby\Main;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemFactory;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class Session
{
    
    /**
     * Session construct.
     * @param Player $player
     * @param SessionScoreboard $scoreboard
     */
    public function __construct(
        private Player $player,
        private SessionScoreboard $scoreboard
    ) {
        $this->init();
    }
    
    private function init(): void
    {
        $this->scoreboard->init();

    }
    
    public function update(): void
    {
        $config = Main::getInstance()->getConfig();
        
        $this->scoreboard->clear();
        
        foreach ($config->get('scoreboard.lines') as $content) {
            $content = str_replace(['{players_count}', '{player_ping}', '{player_nick}'], [count(Main::getInstance()->getServer()->getOnlinePlayers()), $this->player->getNetworkSession()->getPing(), $this->player->getName()], $content);
            $this->scoreboard->addLine(TextFormat::colorize($content));
        }
    }
}
