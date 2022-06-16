<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => [
                'required', 'string', 'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*_#?&]/'
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors());
        $errors = $errors->collapse();
        $response = response()->json([
            'message' => 'Bad Request. Failed to validate!',
            'errors' => $errors
        ], 400);
        throw (new ValidationException($validator, $response));
    }
}
