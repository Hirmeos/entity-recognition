<?php

require_once('EFTermEntity.php');
require_once('EFMultilingual.php');

class EFTerm
{

	public $term; //string
	public $score; //double
	public $entities = array(); //array of TermEntity
	public $multilingual = array(); //array of Multilingual
	
	//Constructor
	function __construct($data) {
		$this->term = $data['EFTerm'];
		$this->score = $data['score'];
		
		$entities = $data["entities"];
		if ($entities){
			foreach ($entities as $entity) {
				array_push($this->entities, new EFTermEntity($entity));
			}
		}
		
		$multilinguals = array_key_exists('EFMultilingual', $data) ? $data["multilingual"] : NULL;
		if ($multilinguals){
			foreach ($multilinguals as $multilingual) {
				array_push($this->multilingual, new EFMultilingual($multilingual));
			}
		}
	}
}