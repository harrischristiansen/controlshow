<?php
/*
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (Code@HarrisChristiansen.com)
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bridge;
use App\Models\Light;

class APIController extends Controller {
	
	// --------------- Bridges ---------------
	
	public function getBridges() {
		return Bridge::select('id','name')->get();
	}
	
	public function getBridge(Bridge $bridge) {
		return $bridge;
	}
	
	// --------------- Lights ---------------
	
	public function getLights() {
		return Light::select('id','name')->get();
	}
	
	public function getLight(Light $light) {
		return $light;
	}

}
