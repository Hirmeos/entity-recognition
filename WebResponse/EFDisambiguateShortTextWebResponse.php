<?php

require_once('EFDisambiguateWebResponse.php');
require_once(__DIR__ . '/../Domain/EFLanguage.php');
require_once(__DIR__ . '/../Domain/EFTextEntity.php');
require_once(__DIR__ . '/../Domain/EFCategory.php');

class EFDisambiguateShortTextWebResponse extends EFDisambiguateWebResponse
{
	public $short_text; //string
	public $language; //Language
	public $entities = array(); //array of TextEntity
	public $categories = array(); //array of Category
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
      		$this->short_text = $json["shortText"];
      		
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
      		
      		$categories = $json["global_categories"];
      		if ($categories){
      			foreach ($categories as $category) {
      				array_push($this->categories, new EFCategory($category));
      			}
      		}
		}
   	}
}