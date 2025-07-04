<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
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
            'name' => 'required',
            'lastname' => 'required',
            'role' => [
                'required',
                'array',
                'min:1',
                'max:2',
                function ($attribute, $value, $fail) {
                    if (
                        (in_array('apprenti_informaticien', $value) || in_array('apprenti_commerce', $value))
                        && count($value) > 1
                    ) {
                        $fail('Si vous choisissez "apprenti informaticien" ou "apprenti commerce", aucune autre option ne peut être sélectionnée.');
                    }
                }
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'domain_id' => ['required', 'exists:domains,id'],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $roles = $this->input('role', []);

            $hasApprenti = collect($roles)->contains(function ($role) {
                return str_starts_with($role, 'apprenti');
            });

            if ($hasApprenti && count($roles) > 1) {
                $validator->errors()->add('role', 'Si un rôle apprenti est sélectionné, aucun autre rôle ne peut être sélectionné en même temps.');
            }
        });
    }


    public function prepareForValidation()
    {
        $this->merge([
            'roles' => $this->role,
        ]);
    }
}
