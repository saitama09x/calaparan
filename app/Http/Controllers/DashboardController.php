<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Students};
class DashboardController extends Controller{

	function __construct(){


	}

	function index(){

		$student = Students::all();

		$obj = [
			'student' => $student
		];
		
		return view('dashboard.dashboard', $obj);
	}


}