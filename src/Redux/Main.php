<?php

namespace Redux;

use Redux\Config;
use Redux\Monkey;
use Redux\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;


class Main extends PluginBase implements Listener {

	public $config;
	public $Monkey;

    public function onLoad() {
    	$this->getLogger()->info("HelperAI by Redux now loaded.");
    }

    public function onEnable() {
      	$this->getLogger()->info("HelperAI by Redux now enabled.");

      	$this->config = new Config();
      	$this->config = $this->config->load();

      	if ($this->config["Sandbox"]===true) {
          $this->getLogger()->info("§6§lLoading HelperAI in sandbox mode.");
          $this->getLogger()->info(print_r($this->config, true));
		    }
        
      	$this->Monkey = new Monkey($this->config["MonkeyKey"], $this->config["MonkeyModuleID"]);

      	$this->getCommand("ask")->setExecutor(new Commands($this));
    }

    public function onDisable() {
        $this->getLogger()->info("HelperAI by Redux now disabled.");
    }
}