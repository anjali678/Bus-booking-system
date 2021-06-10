<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Bus_routeRequest extends FormRequest
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
            'route_id' => 'required|exists:routes,id',
            'status' => 'required|in: "active","blocked"'
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
            'route_id.required' => 'Route id is required!',
            'status.required' => 'status is required!',
            'status.in' => 'status must be active or blocked!'
        ];
    }

}
