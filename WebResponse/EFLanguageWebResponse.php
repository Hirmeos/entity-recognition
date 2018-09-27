<?php

require_once('EFGenericWebResponse.php');

class EFLanguageWebResponse extends EFGenericWebResponse
{
	public $lang; //string
	public $conf; //double
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
			$this->lang = $json['lang'];
			$this->conf = $json['conf'];
		}
   	}
}