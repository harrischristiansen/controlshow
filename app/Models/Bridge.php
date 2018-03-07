<?php
/*
	Bridge Model
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (code@HarrisChristiansen.com)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bridge extends Model
{
    public function lights()
    {
        return $this->hasMany('App\Models\Light');
    }

}
