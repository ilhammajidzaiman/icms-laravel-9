<?php

namespace App\Http\Requests\Private\Post;

use App\Models\Post\BlogTag;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BlogTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255', Rule::unique(BlogTag::class, 'title')->ignore($this->route('id'), 'uuid'),],
        ];
    }
}
