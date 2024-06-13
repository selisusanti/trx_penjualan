<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use App\Exceptions\ApplicationException;


class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'     => ['required','email'],
            'password'  => ['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response([
            'status'  => false,
            'code'    => 401,
            'message' => $validator->errors()->first(),
            'data'    => $validator->errors()->toArray(),
        ]), Response::HTTP_UNPROCESSABLE_ENTITY));

    }
}
