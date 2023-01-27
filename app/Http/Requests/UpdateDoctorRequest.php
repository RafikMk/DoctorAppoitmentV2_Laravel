<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => '',
            'name' => 'required',
            'email' => 'required|email|' . Rule::unique('users', 'email')->ignore('id'),
            'password' => 'min:6|max:25',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'role_id' => 'required',
            'description' => 'required',
            'latitude' =>'required' ,
            'longitude' =>'required' ,
        ];
    }
}
