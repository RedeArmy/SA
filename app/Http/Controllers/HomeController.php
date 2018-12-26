<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DepartamentoController;

class HomeController extends Controller
{
    //
	public function index(Request $request){

		return view('index');
	}
}
