<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'holdername'=>'required',
            'accountnumber'=>'required',
            'ifsccode'=>'required|string|min:11',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location'=>'nullable',
            'mobile'=>'nullable',
            'nominee'=>'nullable',
            'document' => 'nullable',
            'technologies' => 'nullable|array', // Make sure this is an array
            'technologies.*' => 'integer',
            
        ];
    }
    // public function message()
    // {
    //     return
    //     [
    //     'holdername.required'=>'please ente the holder name',
    //     'acccountnumber.required'=>'please enter account number',
    //     'acccountnumber.min'=>'Please enter 12 characters',
    //     'ifsccode.required'=>'enter ifsc code',
    //     'ifsccode.min'=>'Please enter 11 characters',
    //     ];
    // }
}