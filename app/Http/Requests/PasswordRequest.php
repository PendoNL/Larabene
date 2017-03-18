<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method) {
            case 'PATCH':
            case 'PUT':
                return [
                    'password'     => 'required|min:6',
                    'new_password' => 'required|confirmed|min:6',
                ];
                break;

            default:
                return [];
                break;
        }
    }
}
