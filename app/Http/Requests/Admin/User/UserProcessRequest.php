<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserProcessRequest extends FormRequest
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
            'username' => 'required|string|max:255|unique:users,username,'  . $this->id,
            'email' => 'required|email|max:255|unique:users,email,'  . $this->id,
            'phone' => 'nullable|string|digits_between:9,13',
            'role' => 'required|string|max:255',
            'password' => 'nullable|sometimes|string|min:8|required_if:id,null',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute is required',
            '*.unique' => 'The :attribute already exists',
            '*.email' => 'The :attribute must be a valid email address',
            '*.max' => 'The :attribute must be less than :max characters',
            '*.string' => 'The :attribute must be a string',
            '*.digits_between' => 'The :attribute must be more than :min characters and less than :max characters',
            '*.required_if' => 'The :attribute field is required.',
            '*.min' => 'The :attribute must be at least :min characters.',
        ];
    }
}
