<?php

namespace App\Http\Requests;

use Gate;

class ContentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method) {
            case 'POST':
                return Gate::allows('create-content');
                break;

            case 'PATCH':
            case 'PUT':
                return Gate::allows('update-content');
                break;

            default:
                return false;
                break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method) {
            case 'POST':
                return [
                    'title' => 'required',
                    'menu_text' => 'required',
                    'content' => 'required',
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'title' => 'required',
                    'menu_text' => 'required',
                    'content' => 'required',
                ];
                break;

            default:
                return [];
                break;
        }
    }
}
