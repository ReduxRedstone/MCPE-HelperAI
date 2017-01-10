<?php

namespace Redux;

class Config {
	
	public function load() {

		if (!file_exists("./plugins/HelperAI") && !is_dir("./plugins/HelperAI")) {
		    mkdir("./plugins/HelperAI");
		    $defaultAIKey         = "MONKEYLEARN KEY HERE";
		    $defaultModuleID      = "MONKEYLEARN MODULE ID HERE";
		    $defaultMessageTop    = "§a==========§6§lHelperAI§r§a==========§r";
		    $defaultMessageBottom = "§a============================§r";
		    $defaultConfig        = "MonkeyKey: $defaultAIKey\nMonkeyModuleID: $defaultModuleID\nTop Text: $defaultMessageTop\nBottom Text: $defaultMessageBottom\nSandbox: true\n\nResponses:\n default: §cI am not yet configured to properly answer that type of question.§r";

			$yaml = fopen("./plugins/HelperAI/config.yml", "wb");
			fwrite($yaml, $defaultConfig);
			fclose($yaml);
		}

		$config = file_get_contents("./plugins/HelperAI/config.yml");
		$config = yaml_parse($config);

		return $config;
	}
}