<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;;

class LoginUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users'],
            'password' => [
                'required', 'string', 'min:6',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*_#?&]/' // must contain a special character],
            ]
        ];
    }

    public function messages()
    {
        return [
            "required" => ":attribute is required",
            "email" => ":attribute is unvalid",
            "min" => ":attribute should be minimum 6 characters",
            "regex" => ":attribute must contain at least one lowercase, uppercase, digit and special character"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors());
        $errors = $errors->collapse();
        $response = response()->json([
            'success' => false,
            'message' => 'Error Validation',
            'errors' => $errors
        ]);
        throw (new ValidationException($validator, $response));
    }
}
