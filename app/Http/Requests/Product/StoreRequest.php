<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return bool* Determine if the user is authorized to make this request.
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
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|image',
            'price' => 'required|integer|min:0',
            'old_price' => 'required|integer|min:0',
            'count' => 'required|integer|min:0',
            'is_published' => 'nullable|boolean',
            'category_id' => 'required|integer|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'colors' => 'nullable|array',
            'colors.*' => 'integer|exists:colors,id',
            'group_id' => 'nullable|integer|exists:groups,id',
            'product_images' => 'nullable|array',
        ];
    }
}
