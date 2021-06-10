<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;

class Bus_schedule_bookingRequest extends FormRequest
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
            'bus_seate_id' => 'required|exists:bus_seates,id',
            'user_id' => 'required|exists:users,id',
            'bus_schedule_id' => 'required|exists:bus_schedules,id',
            'seat_number' => 'required|exists:bus_seates,seat_number',
            'price' => 'required',
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
            'bus_seate_id.required' => 'bus seate id is required!',
            'user_id.required' => 'user id is required!',
            'bus_schedule_id.required' => 'bus schedule id number is required!',
            'seat_number.required' => 'seat_number id is required!',
            'price.required' => 'price id is required!',
            'status.required' => 'status id is required!',
            'status.in' => 'status must be active or blocked!'
        ];
    }

}
