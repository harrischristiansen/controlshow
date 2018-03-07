<?php
/*
	Edit Item Request Validator - github.com/harrischristiansen/inventory
	File Created by Harris Christiansen (HarrisChristiansen.com)
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditItemRequest extends FormRequest
{
    public function authorize()
    {
	    return true;
    }
    
    public function rules()
    {
        return [
            'name'      	=> 'required|max:255',
            'description'   => 'max:5000',
            'quantity'    	=> 'nullable|numeric',
            'category'    	=> 'max:255',
            'url'   		=> 'nullable|url',
        ];
    }
}
