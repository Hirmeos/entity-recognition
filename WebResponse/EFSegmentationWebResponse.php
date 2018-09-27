<?php

require_once('EFGenericWebResponse.php');
require_once(__DIR__ . '/../Domain/EFSentence.php');

class EFSegmentationWebResponse extends EFGenericWebResponse
{
	public $sentences = array(); //array of Sentence
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
			$sentences = $json["sentences"];
			if ($sentences){
				foreach ($sentences as $sentence) {
					array_push($this->sentences, new EFSentence($sentence));
				}
			}
		}
   	}
}