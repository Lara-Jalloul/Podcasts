<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class PodcastRequest extends FormRequest
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
            'title' => 'required',
            'author' => 'required',
            'description' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors());
        $errors = $errors->collapse();
        $response = response()->json([
            'message' => 'Bad Request. Failed to validate!',
            'errors' => $errors
        ],400);
        throw (new ValidationException($validator, $response));
    }
}
