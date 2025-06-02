<?php

namespace App\Http\Requests\Private\Post;

use App\Models\Post\Page;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255', Rule::unique(Page::class, 'title')->ignore($this->route('id'), 'uuid'),],
            'content' => ['required', 'max:5120'],
            'file' => ['nullable', 'string'],
        ];
    }
}
