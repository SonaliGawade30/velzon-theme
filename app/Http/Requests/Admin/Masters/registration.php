<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name'=>'required|name',
            'mobile'=>'required|mobile',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',  
        ];
    }
    public function message()
    {
        return[

            'name.required'=>'please enter your name',
            'mobile.required'=>'please enter your contact',
            'email.required' => 'Please enter your email address',
            'username.required' => 'Please enter your username',
            'password.required' => 'Please enter your password',
        ];
    }
}