<?php

require_once('EFDisambiguateWebResponse.php');
require_once(__DIR__ . '/../Domain/EFLanguage.php');
require_once(__DIR__ . '/../Domain/EFTextEntity.php');
require_once(__DIR__ . '/../Domain/EFCategory.php');

class EFDisambiguateTextWebResponse extends EFDisambiguateWebResponse
{
	public $search_text; //string
	public $language; //Language
	public $entities = array(); //array of TextEntity
	public $categories = array(); //array of Category
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
      		$this->search_text = $json["text"];
      		
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
      		
      		$categories = array_key_exists('global_categories', $json) ? $json["global_categories"] : NULL;
      		if ($categories){
      			foreach ($categories as $category) {
      				array_push($this->categories, new EFCategory($category));
      			}
      		}
		}
   	}
}