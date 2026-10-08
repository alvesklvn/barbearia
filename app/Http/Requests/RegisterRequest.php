<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|regex:/^[A-Za-zÀ-ú 0-9_-]+$/|min:5|max:15',
            'email' => 'required|string|email:rfc,dns',
            'password' => ['required', 'string', RulesPassword::min(8)->letters()->numbers()->symbols(), 'max:20'],
            'cellphone' => 'required|integer|min:10|max:12'
        ];
    }
}
