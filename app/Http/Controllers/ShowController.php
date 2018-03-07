<?php
/*
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (Code@HarrisChristiansen.com)
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ShowController extends Controller {
	
	public function getIndex() {
		return view('pages.home');
	}
	
	public function getAbout() {
		return view('pages.about');
	}

}
