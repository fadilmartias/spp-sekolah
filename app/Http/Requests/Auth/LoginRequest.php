<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'The :attribute field is required.',
            'login.string' => 'The :attribute must be a string.',
            'login.max' => 'The :attribute must be less than :max characters.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute must be a string.',
            'password.min' => 'The :attribute must be at least :min characters.',
        ];
    }

    public function attributes(): array
    {
        return [
            'login' => 'email / username'
        ];
    }
}
