<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreationRequest extends FormRequest
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
            //
            'title' => 'required|string',
            'description' => 'required|string',
            'apprentis_id' => 'required|integer',
            'files' => 'array|nullable|max:5',
            'files.*' => 'nullable|file|mimes:txt,doc,docx,pdf,jpg,jpeg,png|max:4096',
        ];
    }
}
