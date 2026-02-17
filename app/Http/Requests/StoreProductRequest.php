<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sku' => ['required', Rule::unique('products', 'sku')->ignore($this->product->id)],
            'name' => 'required|string|max:255|min:3',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'category' => 'string|max:255',
            'status' => 'required|in:active,inactive'
        ];
    }

    public function messages(): array
    {
        return [
            'sku.required' => 'O campo :attribute é obrigatório.',
            'sku.unique' => 'O campo :attribute é único.',
            'name.required' => 'O campo :attribute é obrigatório.',
            'name.string' => 'O campo :attribute deve ser uma string.',
            'name.max' => 'O campo :attribute deve ter no máximo 255 caracteres.',
            'name.min' => 'O campo :attribute deve ter no mínimo 3 caracteres.',
            'description.string' => 'O campo :attribute deve ser uma string.',
            'price.numeric' => 'O campo :attribute deve ser um número.',
            'price.min' => 'O campo :attribute deve ser no mínimo 0.',
            'category.string' => 'O campo :attribute deve ser uma string.',
            'category.max' => 'O campo :attribute deve ter no máximo 255 caracteres.',
            'status.required' => 'O campo :attribute é obrigatório.'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422)
        );
    }
}
