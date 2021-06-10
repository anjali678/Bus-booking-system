<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Bus_scheduleRequest extends FormRequest
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
            'bus_route_id' => 'required|exists:bus_routes,id',
            'end_timestamp' => 'required',
            'start_timestamp' => 'required',
            'direction' => 'required|in: "forward","revers"'
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
            'bus_route_id.required' => 'bus_route id is required!',
            'end_timestamp.required' => 'end_timestamp is required!',
            'start_timestamp.required' => 'start_timestamp is required!',
            'direction.required' => 'direction is required!'
        ];
    }

}
       