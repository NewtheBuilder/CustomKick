<?php

namespace kick;

use pocketmine\command\defaults\KickCommand;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class main extends PluginBase implements Listener{

    public function onEnable() {

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("Kick", new CustomKick("ckick", $this));

    }



}