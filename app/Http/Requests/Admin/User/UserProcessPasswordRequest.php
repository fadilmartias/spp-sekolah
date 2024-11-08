<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserProcessPasswordRequest extends FormRequest
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
            'id' => 'required|integer',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.integer' => 'The :attribute must be an integer.',
            '*.min' => 'The :attribute must be at least :min characters.',
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
