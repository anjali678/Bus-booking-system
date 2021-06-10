<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'vehical_number' => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return[
            'name.required' => 'Name is required!',
            'type.required' => 'Type is required!',
            'vehical_number.required' => 'Vehical number is required!'
        ];
    }

}
