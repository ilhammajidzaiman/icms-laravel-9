<?php

namespace App\Http\Requests\Private\Setting;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isMethod = $this->isMethod('post');
        return [
            'name' => [
                'required',
                'string'
            ],
            'username' => [
                'required',
                'max:255',
                Rule::unique(User::class, 'username')->ignore($this->route('id'), 'uuid'),
            ],
            'email' => [
                'required',
                'max:255',
                Rule::unique(User::class, 'email')->ignore($this->route('id'), 'uuid'),
            ],
            'file' => [
                'nullable',
                'string'
            ],
            // 'password' => [
            //     $isMethod ? 'required' : 'nullable',
            //     'max:255',
            //     'min:6',
            //     'same:password_confirmation',
            // ],
            // 'password_confirmation' => [
            //     $isMethod ? 'required' : 'nullable',
            //     'max:255',
            //     'min:6',
            //     'same:password',
            // ],
        ];
    }
}
