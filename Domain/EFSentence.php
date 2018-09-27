<?php
class EFSentence
{

	public $offset_start; //int
	public $offset_end; //int
	
	//Constructor
	function __construct($data) {
		$this->offset_start = $data['offsetStart'];
		$this->offset_end = $data['offsetEnd'];
	}
}