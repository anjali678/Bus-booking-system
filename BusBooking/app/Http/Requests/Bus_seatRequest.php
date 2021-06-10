<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Bus_seatRequest extends FormRequest
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
            'bus_id' => 'required|exists:buses,id',
            'seat_number' => 'required',
            'price' => 'required|numeric'
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
            'bus_id.required' => 'Bus id is required!',
            'seat_number.required' => 'Seat number is required!',
            'price.required' => 'Price number is required!'
        ];
    }
}
