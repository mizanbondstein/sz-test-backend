<?php

namespace App\Http\Requests;

use App\Traits\RequestResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class StoreProductRequest extends FormRequest
{
    use RequestResponse;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'price' => ['required','numeric'],
            'description' => ['required'],
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'category_id' => ['required'],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        $errors = [];

        foreach ($validator->errors()->messages() as $field => $messages) {
            $errors[] = [

                $field => implode(', ', $messages),
            ];
        }

        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation failed!',
            'errors' => $errors,
        ], 422));
    }
}
