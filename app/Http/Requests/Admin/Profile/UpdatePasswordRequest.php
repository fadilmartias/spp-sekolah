<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:8|current_password:web',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|min:8|same:new_password',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.min' => 'The :attribute must be at least :min characters.',
            '*.current_password' => 'The :attribute is incorrect.',
            '*.different' => 'The :attribute cannot be the same as the current password.',
            '*.same' => 'The password confirmation does not match.',
        ];
    }

    public function attributes(): array
    {
        return [
            'old_password' => 'current password',
            'new_password' => 'new password',
            'confirm_password' => 'confirm password',
        ];
    }
}
