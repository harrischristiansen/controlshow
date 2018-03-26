<?php
/*
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (Code@HarrisChristiansen.com)
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
	
	// --------------- Bridge Discovery ---------------
	
	public function getLocalBridges() {
		$client = new Client();
		$r = $client->get('https://www.meethue.com/api/nupnp');
		if ($r->getStatusCode() != 200) {
			return [];
		}
		return json_decode($r->getBody());
		
	}
	
	public function addBridge($ipAddr) {
		$client = new Client();
		$r = $client->post("http://".$ipAddr."/api", [
			'body' => '{"devicetype":"my_hue_app#iphone controlshow"}'
		]);
		if ($r->getStatusCode() != 200) {
			return ['error' => 'request failed'];
		}
		$result = json_decode($r->getBody(), true);
		foreach ($result as $item) {
			if (isset($item['error'])) {
				return ['error' => $item['error']];
			}
		}
		return ['success' => 'added'];
	}
	
	// --------------- Lights ---------------
	
	public function getLights() {
		return Light::select('id','name')->get();
	}
	
	public function getLight(Light $light) {
		return $light;
	}

}
