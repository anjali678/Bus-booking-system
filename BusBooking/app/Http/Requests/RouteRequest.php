<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'node_one' => 'required',
            'node_two' => 'required',
            'route_number' => 'required',
            'distance' => 'required|integer',
            'time' => 'required|timestamp'
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
            'node_one.required' => 'Node_one is required!',
            'node_two.required' => 'Node_two is required!',
            'route_number.required' => 'Route Number is required!',
            'distance.required' => 'Distance is required!',
            'time.required' => 'Time is required!'
        ];
    }
}
