<?php
/*
	Light Model
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (code@HarrisChristiansen.com)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
	public function bridge()
	{
		return $this->belongsTo('App\Models\Bridge');
	}
}
