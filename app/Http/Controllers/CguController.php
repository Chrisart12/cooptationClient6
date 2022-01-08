<?php

namespace App\Http\Controllers;

use Datetime;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CguController extends Controller
{
	// Show cgu page
	public function showCguPage(){
		
		return view('cgu');
	}
}