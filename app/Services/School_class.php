<?php

namespace App\Services;
use App\Models\{Schools};

class School_class{
	
	private $name;
	private $id;
	private $district;
	private $division;
	private $region;

	function __construct(){
		$this->name = "";
		$this->id = "";
		$this->district = "";
		$this->division = "";
		$this->region = "";
	}

	function set_school(Schools $school){
		$this->name = $school->shname;
		$this->id = $school->shid;
		$this->district = $school->district;
		$this->division = $school->division;
		$this->region = $school->division;
	}

	function get_name(){
		return $this->name;
	}

	function get_id(){
		return $this->id;
	}

	function get_district(){
		return $this->district;
	}

	function get_division(){
		return $this->division;
	}

	function get_region(){
		return $this->region;
	}

}


?>