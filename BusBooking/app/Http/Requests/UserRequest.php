<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if(request()->is('api/register')){
            return[
                'email' => 'required|email|unique:users',
                'name' => 'required|string|max:50',
                'password' => 'required'
            ];
        }
        else if(request()->is('api/adminLogin')){
            return[
                'email' => 'required|email|exists:super_admins,email',
                'password' => 'required'
            ];
        }else if(request()->is('api/login')){
            return[
                'email' => 'required|email',
                'password' => 'required'
            ];
        }else if(request()->is('api/resetPassword')){
            return[
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|min:8'
            ];
        }
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        if(request()->is('api/register')){
            return[
                'email.required' => 'Email is required!',
                'name.required' => 'Name is required!',
                'password.required' => 'Password is required!'
            ];
        }else if(request()->is('api/adminLogin')){
            return[
                'email.required' => 'Email is required!',
                'password.required' => 'Password is required!'
            ];
        }else if(request()->is('api/login')){
            return[
                'email.required' => 'Email is required!',
                'password.required' => 'Password is required!'
            ];
        }else if(request()->is('api/resetPassword')){
            return[
                'old_password.required' => 'old password is required!',
                'new_password.required' => 'new password is required!',
                'confirm_password.required' => 'confirm password is required!'
            ];
        }
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        if(request()->isMethod('register')){
            return [
                'email' => 'trim|lowercase',
                'name' => 'trim|capitalize|escape'
            ];
        }
    }

}
