<?php

namespace Redux;

class Monkey {

 	private $key;
 	private $module_id;
 	private $monkey;
	
	public function __construct($key, $module_id) {
		$this->key = $key;
		$this->module_id = $module_id;
	}

	public function ask($question, $sandbox=false) {
		$payload = ["text_list" => $question];
		if ($sandbox===true) {
			$url = "https://api.monkeylearn.com/v2/classifiers/$this->module_id/classify/?sandbox=1";
		} else {
			$url = "https://api.monkeylearn.com/v2/classifiers/$this->module_id/classify/";
		}
		$curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Token '.$this->key));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($curl);
        curl_close($curl);
		return $response;
	}
}