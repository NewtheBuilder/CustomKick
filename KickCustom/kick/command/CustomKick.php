<?php

namespace kick\command;

use kick\command;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\TranslationContainer;
use pocketmine\utils\TextFormat;

class CustomKick extends Command {

    public function __construct() {
        parent::__construct("ckick");
        $this->description = "Permet de kick un joueur";
        $this->usageMessage = "/ckick <player> [reason...]";
        $this->setPermission("ckick.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$this->testPermission($sender)){
            $sender->sendMessage(new TranslationContainer("commands.generic.permission"));
            return false;
        }
        if (count($args) <= 0) {
            $sender->sendMessage("/ckick <player> [reason...]");
            return false;
        }
        $player = $sender->getServer()->getPlayer($args[0]);
        if (count($args) == 1) {
            if ($player != null) {
                $sender->getServer()->broadcastMessage(TextFormat::AQUA. "Kick:" . $sender->getName(). TextFormat::RED . " §7à été kick du serveur \n§7Kick par :". $sender->getName()." §7Raison : Aucune.");

                $player->kick(TextFormat::AQUA. "kick :" .  TextFormat::RED . " §7Tu as été kick du serveur \n§7Par un Staff \n§7Raison: Aucune" , false);
            } else {
                $sender->sendMessage(TextFormat::RED ."§cLe Joueur n'existe pas");
            }
        } else if (count($args) >= 2) {
            if ($player != null) {
                $reason = "";
                for ($i = 1; $i < count($args); $i++) {
                    $reason .= $args[$i];
                    $reason .= " ";
                }
                $reason = substr($reason, 0, strlen($reason) - 1);

                $sender->getServer()->broadcastMessage(TextFormat::AQUA. "kick:" . $player->getName().TextFormat::RED . " §7ta été kick du servuer\n§7Kick par ". $sender->getName(). "\nRaison: " . TextFormat::AQUA . "§7"$reason);

                    $player->kick(TextFormat::AQUA. "Kick:" . TextFormat::RED . " Tu as été kick du serveur \nPar un Staff \n§7Raison: " . TextFormat::AQUA . $reason , false);
                } else {
                $sender->sendMessage("§cLe Joueur n'existe pas");
            }
        }


        return true;
    }
}