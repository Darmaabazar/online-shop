<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string',
            'slug' => 'required|unique:products,slug',
            'description' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,jpg,png,gif,webp|required|max:2048',
            'price' => 'required|numeric|min:0',
            'sale_percent' => 'required|numeric|min:0|max:100',
            'quantity' => 'required|numeric|min:0',
            'trending' => 'nullable|in:on,off',
            'status' => 'required|in:on,off',
            'images.*' => 'required|image|max:2048',
        ];
    }
}
