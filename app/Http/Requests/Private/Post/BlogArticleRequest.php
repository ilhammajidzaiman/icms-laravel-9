<?php

namespace App\Http\Requests\Private\Post;

use Illuminate\Validation\Rule;
use App\Models\Post\BlogArticle;
use Illuminate\Foundation\Http\FormRequest;

class BlogArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => ['required', 'max:255'],
            'title' => ['required', 'max:255', Rule::unique(BlogArticle::class, 'title')->ignore($this->route('id'), 'uuid'),],
            'content' => ['required', 'max:5120'],
            'is_show' => ['nullable', 'string'],
            'file' => ['nullable', 'string'],
            'attachment' => ['nullable', 'array'],
            'attachment.*' => ['nullable', 'string'],
        ];
    }
}
