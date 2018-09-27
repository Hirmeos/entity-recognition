<?php
class EFMultilingual
{

	public $lang; //string
	public $term; //double
	public $page_id; //int (?)
	
	//Constructor
	function __construct($data) {
		$this->lang = $data['lang'];
		$this->term = $data['EFTerm'];
		$this->page_id = $data['page_id'];
	}
}