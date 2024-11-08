<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email|max:255',
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The :attribute field is required.',
            'email.email' => 'The :attribute must be a valid email address.',
            'email.unique' => 'The :attribute has already been taken.',
            'email.max' => 'The :attribute must be less than :max characters.',
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute must be a string.',
            'name.max' => 'The :attribute must be less than :max characters.',
            'username.required' => 'The :attribute field is required.',
            'username.string' => 'The :attribute must be a string.',
            'username.unique' => 'The :attribute has already been taken.',
            'username.max' => 'The :attribute must be less than :max characters.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute must be a string.',
            'password.min' => 'The :attribute must be at least :min characters.',
            'confirm_password.required' => 'The :attribute field is required.',
            'confirm_password.min' => 'The :attribute must be at least :min characters.',
            'confirm_password.same' => 'The password confirmation does not match.',
        ];
    }

    public function attributes(): array
    {
        return [
            'confirm_password' => 'confirm password',
        ];
    }
}
