<?php

require_once('EFDisambiguateWebResponse.php');
require_once(__DIR__ . '/../Domain/EFLanguage.php');
require_once(__DIR__ . '/../Domain/EFTextEntity.php');
require_once(__DIR__ . '/../Domain/EFPage.php');

class EFDisambiguatePDFWebResponse extends EFDisambiguateWebResponse
{
	public $language; //Language
	public $entities = array(); //array of TextEntity
	public $pages = array(); //array of Page
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
      		$lang_data = $json["language"];
      		if ($lang_data){
      			$this->language = new EFLanguage($lang_data);
      		}
      		
      		$entities = $json["entities"];
      		if ($entities){
      			foreach ($entities as $entity) {
      				array_push($this->entities, new EFTextEntity($entity));
      			}
      		}
      		
      		$pages = $json["pages"];
      		if ($pages){
      			foreach ($pages as $page) {
      				array_push($this->pages, new EFPage($page));
      			}
      		}
		}
   	}
}