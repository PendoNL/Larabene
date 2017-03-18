<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('anything');
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
                    'title'     => 'required',
                    'menu_text' => 'required',
                    'content'   => 'required',
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'title'     => 'required',
                    'menu_text' => 'required',
                    'content'   => 'required',
                ];
                break;

            default:
                return [];
                break;
        }
    }
}
