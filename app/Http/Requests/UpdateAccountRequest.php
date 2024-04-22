<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nis' => [Rule::requiredIf(auth()->user()->isStudent()), Rule::unique('users', 'nis')->ignore(auth()->user()->id)],
            'username' => ['required', Rule::unique('users', 'username')->ignore(auth()->user()->id)],
            'name' => 'required',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
        ];
    }
}
