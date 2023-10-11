<?php

namespace App\Http\Requests\Gestion;

use Illuminate\Foundation\Http\FormRequest;

class CircuitForm extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom'=>['required', 'min:5'],
            'description'=>['required', 'min:5'],
            'duree'=>['required', 'integer', 'min:1'],
            'photo'=>['required'],
            'prix_estimatif'=>['required','integer', 'min:1'],
            'visible'=>['required', 'boolean'],
            'id_categorie'=>['required', 'min:0'],
        ];
    }
}
