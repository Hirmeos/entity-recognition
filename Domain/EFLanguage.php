<?php
class EFLanguage
{

	public $lang; //string
	public $conf; //double
	
	//Constructor
	function __construct($data) {
		$this->lang = $data['lang'];
		$this->conf = $data['conf'];
	}
}