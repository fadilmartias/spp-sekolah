<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|digits_between:9,13',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute is required',
            '*.string' => 'The :attribute must be a string',
            '*.max' => 'The :attribute must be less than :max characters',
            '*.unique' => 'The :attribute already exists',
            '*.email' => 'The :attribute must be a valid email address',
            '*.digits_between' => 'The :attribute must be more than :min characters and less than :max characters',
        ];
    }
}
