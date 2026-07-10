<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|image',
            'price' => 'required|integer|min:0',
            'count' => 'required|integer|min:0',
            'is_published' => 'nullable|boolean',
            'category_id' => 'required|integer|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'colors' => 'nullable|array',
            'colors.*' => 'integer|exists:colors,id',
        ];
    }
}
