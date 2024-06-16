<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ApplicationException;

class ProductSaveRequest extends FormRequest
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
            'code' => ['required'],
            'product_name' => ['required'],
            'description' => ['required'],
            'price' => ['required','integer'],
            'stock' => ['required','integer'],
            'picture' => ['nullable','image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'suplier_id' => ['required','exists:supliers,id'],
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
