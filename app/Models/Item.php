<?php
/*
	Item Model - github.com/harrischristiansen/inventory
	File created by Harris Christiansen (HarrisChristiansen.com)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;
	
	public function photos()
	{
		return $this->hasMany('App\Models\Photo');
	}
	
	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}
	
	public function itemName()
	{
		return $this->name ?: "Unnamed Item";
	}
	
	public function editURL()
	{
		return route("editItem", [$this]);
	}
	
	public function postURL()
	{
		if ($this->id == 0) {
			return route("createItem-post");
		}
		return route("editItem-post", [$this]);
	}
}
