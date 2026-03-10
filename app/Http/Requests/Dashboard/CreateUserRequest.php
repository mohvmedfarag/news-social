<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string'],
            'email'    => ['required', 'string', 'unique:users,email'],
            'username' => ['required', 'string', 'unique:users,username'],
            'phone'    => ['required', 'string', 'unique:users,phone'],
            'password' => ['required', 'confirmed'],
            'country'  => ['nullable', 'string'],
            'city'     => ['nullable', 'string'],
            'street'   => ['nullable', 'string'],
            'status'   => ['nullable', 'in:1,0'],
            'email_verified_at'   => ['nullable', 'in:1,0'],
            'image'    => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,tmp,svg'],
        ];
    }
}
