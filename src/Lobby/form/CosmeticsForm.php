<?php

namespace Lobby\form;

use cosmicpe\form\entries\simple\Button;
use cosmicpe\form\SimpleForm;
use Lobby\session\SessionFactory;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;


class CosmeticsForm extends SimpleForm
{

    public function __construct()
    {
        parent::__construct("§r§7» §l§6Cosmetics §r§7«", "§r§7Select a cosmetic");
        $this->addButton(new Button("§6RainbowArmor\n§r§7Click to activate or deactivate the Rainbow armor"), function (Player $player, int $index) {
            if (!$player->hasPermission('rainbow.armor.permission')) {
                //MESSAGE
                return;
            }
            $session = SessionFactory::getSession($player);

            if ($session !== null) {
                if ($session->isRainbowArmor()) {
                    $session->setRainbowArmor(false);
                    $player->getArmorInventory()->clearAll();
                } else {
                    $session->setRainbowArmor(true);
                    $player->getArmorInventory()->setContents([
                        ItemFactory::getInstance()->get(298),
                        ItemFactory::getInstance()->get(299),
                        ItemFactory::getInstance()->get(300),
                        ItemFactory::getInstance()->get(301)
                    ]);
                }
            }
            //$player->getServer()->dispatchCommand($player, "cfa");
        });
        $this->addButton(new Button("§6Cape\n§r§7Click to activate or deactivate a cape"), function (Player $player, int $index) {
            $player->getServer()->dispatchCommand($player, "capes");
        });
        $this->addButton(new Button("§6Fly\n§r§7Click to activate or deactivate the fly"), function (Player $player, int $index) {
            $player->getServer()->dispatchCommand($player, "fly");
        });
    }
}