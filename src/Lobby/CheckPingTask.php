<?php

declare(strict_types=1);


namespace Lobby;


use Lobby\session\SessionFactory;
use pocketmine\scheduler\Task;

class CheckPingTask extends Task {

    public function onRun(): void {
        foreach(SessionFactory::getSessions() as $session) {
            if($session->checkPing()) {
                $session->update();
            }
        }
    }

}