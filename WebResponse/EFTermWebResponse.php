<?php

require_once('EFGenericWebResponse.php');
require_once(__DIR__ . '/../Domain/EFSense.php');

class EFTermWebResponse extends EFGenericWebResponse
{
	public $term; //string
	public $lang; //string
	public $senses = array(); //array of Sense
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
			$this->term = $json['EFTerm'];
			$this->lang = $json['lang'];
			
			$senses = $json["senses"];
			if ($senses){
				foreach ($senses as $sense) {
					array_push($this->senses, new EFSense($sense));
				}
			}
		}
   	}
}