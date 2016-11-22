<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateClient extends FormRequest
{
    /**
     * Determine if the client is authorized to make this request.
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
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'status' => 'required',
            'role_id' => 'required|exists:roles,id'
        ];
    }
}
