<?php

namespace App\Http\Requests\Private\Post;

use Illuminate\Validation\Rule;
use App\Models\Post\BlogCategory;
use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255', Rule::unique(BlogCategory::class, 'title')->ignore($this->route('id'), 'uuid'),],
        ];
    }
}
