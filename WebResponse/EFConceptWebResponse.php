<?php

require_once('EFGenericWebResponse.php');
require_once(__DIR__ . '/../Domain/EFCategory.php');
require_once(__DIR__ . '/../Domain/EFTermEntityDefinition.php');
require_once(__DIR__ . '/../Domain/EFMultilingual.php');
require_once(__DIR__ . '/../Domain/EFStatement.php');

class EFConceptWebResponse extends EFGenericWebResponse
{
	public $raw_name; //string
	public $preferred_term; //string
	public $nerd_score; //double
	public $nerd_selection_score; //double
	public $wikipedia_ext_ref; //int (?)
	public $wikidata_id; //string
	public $definitions = array(); //array of TermEntityDefinition
	public $categories = array(); //array of Category
	public $domains = array(); //array of strings
	public $multilingual = array(); //array of Multilingual
	public $statements = array(); //array of Statement
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
			$this->raw_name = $json['rawName'];
			$this->preferred_term = $json['preferredTerm'];
			$this->nerd_score = $json['nerd_score'];
			$this->nerd_selection_score = $json['nerd_selection_score'];
			$this->wikipedia_ext_ref = $json['wikipediaExternalRef'];
			$this->wikidata_id = $json['wikidataId'];
			
			$definitions = $json["definitions"];
			if ($definitions){
				foreach ($definitions as $definition) {
					array_push($this->definitions, new EFTermEntityDefinition($definition));
				}
			}
			
			$categories = $json["categories"];
			if ($categories){
				foreach ($categories as $category) {
					array_push($this->categories, new EFCategory($category));
				}
			}
			
			$this->domains = $json['domains'];
			
			$multilinguals = $json["multilingual"];
			if ($multilinguals){
				foreach ($multilinguals as $multilingual) {
					array_push($this->multilingual, new EFMultilingual($multilingual));
				}
			}
			
			$statements = $json["statements"];
			if ($statements){
				foreach ($statements as $statement) {
					array_push($this->statements, new EFStatement($statement));
				}
			}
		}
   	}
}