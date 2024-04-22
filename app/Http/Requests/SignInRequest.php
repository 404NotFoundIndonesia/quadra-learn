<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
            'remember-me' => 'nullable',
        ];
    }

    public function getCredential(): array
    {
        $username = $this->get('username');

        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }

        return $this->only('username', 'password');
    }

    private function isEmail($param): bool
    {
        try {
            $factory = $this->container->make(ValidationFactory::class);

            return !$factory->make(
                ['username' => $param],
                ['username' => 'email']
            )->fails();
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
