<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'mob_country_code' => 'required',
            'mobile_no' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator) {
        $errors = (new ValidationException($validator))->errors();

        $response['status'] = 400;
        $response['Message'] = 'Please fill the required fields';
        throw new HttpResponseException(
            response()->json(['errors' => $errors, 'response' => $response ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
