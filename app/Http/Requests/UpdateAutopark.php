<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAutopark extends FormRequest
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
        $rules =  [
            'name' => 'required|string|max:256',
            'address' => 'required|string|max:256',
            'hours' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9])-(2[0-3]|[01]?[0-9])$/'],
            'newCars.*.number' => ['required', 'distinct', Rule::unique('cars', 'number')],
            'newCars.*.driver' => 'required',
            'updatedCars.*.driver' => 'required'
        ];

        $updatedCarsNumbers = [];

        foreach ($this->request->get('updatedCars') as $key => $val) {
            $updatedCarsNumbers[] = $val['number'];
            $rules['updatedCars.' .
                $key .
                '.number'] = ['required', 'distinct', 'unique:cars,number,' . $val['id']];
        }

        foreach ($this->request->get('newCars') as $key => $val) {
            $rules['newCars.' . $key . '.number'] = [
                'required',
                'distinct',
                Rule::unique('cars', 'number'),
                Rule::notIn($updatedCarsNumbers)];
        }
        return $rules;
    }
}
