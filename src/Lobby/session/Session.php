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
        
        $this->player->setGamemode(GameMode::fromString('survival'));
        
        $this->player->teleport($this->player->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

        $this->player->setHealth(20);
        
        $this->player->getHungerManager()->setEnabled(false);
        $this->player->getHungerManager()->setFood(20);
        
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        
        $item = ItemFactory::getInstance()->get(ItemIds::COMPASS);
        $item->setCustomName(TextFormat::colorize('&l&4Modalities'));
        $item->setNamedTag($item->getNamedTag()->setString('no_drop', 'modalities'));
        
        $this->player->getInventory()->setItem(4, $item);
    }
    
    public function update(): void
    {
        $config = Main::getInstance()->getConfig();
        
        $this->scoreboard->clear();
        
        foreach ($config->get('ScoreBoardLines') as $content) {
            $content = str_replace(['{players_count}', '{player_ping}'], [count(Main::getInstance()->getServer()->getOnlinePlayers()), $this->player->getNetworkSession()->getPing()], $content);
            $this->scoreboard->addLine(TextFormat::colorize($content));
        }
    }
}