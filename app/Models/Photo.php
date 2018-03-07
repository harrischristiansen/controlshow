<?php
/*
	Inventory Photo Model - github.com/harrischristiansen/inventory
	File created by Harris Christiansen (HarrisChristiansen.com)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
	use SoftDeletes;
	
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    
    public function url()
    {
	    return "/photos/".$this->filename;
    }
    
    public function iconURL()
    {
	    return "/photos/".$this->iconname;
    }

}
