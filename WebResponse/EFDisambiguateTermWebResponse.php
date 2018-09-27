<?php

require_once('EFDisambiguateWebResponse.php');
require_once(__DIR__ . '/../Domain/EFTerm.php');

class EFDisambiguateTermWebResponse extends EFDisambiguateWebResponse
{
	public $terms = array(); //array of Term
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
      		$terms = $json["termVector"];
      		if ($terms){
      			foreach ($terms as $term) {
      				array_push($this->terms, new EFTerm($term));
      			}
      		}
		}
   	}
}