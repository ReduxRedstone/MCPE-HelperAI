<?php

namespace Redux;

use Redux\Config;
use Redux\Monkey;
use Redux\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;


class Commands implements CommandExecutor {

    private $server;

    public function __construct($server) {
        $this->server = $server;
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        switch($command->getName()) {
            case "ask":
                if (count($args) == 0) {
                    $sender->sendMessage("§4§l[ERROR]§r§c You must ask a question!§r");
                    return false;
                }

                $sender->sendMessage("§aAsking your question. Please wait...");

                $question = implode(" ", $args);
                $reply = json_decode($this->server->Monkey->ask($question, $this->server->config["Sandbox"]), true);

                if (isset($this->server->config["Responses"][$reply["result"][0][0]["label"]])) {
                    $answer = $this->server->config["Responses"][$reply["result"][0][0]["label"]];
                } else {
                    $answer = $this->server->config["Responses"]["default"];
                }
                
                $sender->sendMessage($this->server->config["Top Text"]."\n".$answer."\n".$this->server->config["Bottom Text"]);
                return true;
        }
    }
}