<?php
/*
	Update Photo Request Validator - github.com/harrischristiansen/inventory
	File Created by Harris Christiansen (HarrisChristiansen.com)
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends FormRequest
{
    public function authorize()
    {
	    return true;
    }
    
    public function rules()
    {
        return [
            'title'	=> 'max:255',
            'file'	=> 'required|file',
        ];
    }
}
