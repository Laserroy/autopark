<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAutopark extends FormRequest
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
            'name' => 'required|string|max:256',
            'address' => 'required|string|max:256',
            'hours' => ['regex:/^(2[0-3]|[01]?[0-9])-(2[0-3]|[01]?[0-9])$/'],
            'cars.*.number' => 'required',
            'cars.*.driver' => 'required'
        ];
    }
}
