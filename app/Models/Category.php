<?php
/*
	Category Model - github.com/harrischristiansen/inventory
	File created by Harris Christiansen (HarrisChristiansen.com)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
        'name',
    ];
    
	public function items()
	{
		return $this->hasMany('App\Models\Item');
	}
}
