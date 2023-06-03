<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarDenunciaRequest extends FormRequest
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
            
            'user_id' => 'required|email',
            'titulo' => 'required',
            'descripcion' => 'required',
            'tipo_denuncia' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'imagen1' => 'required',
            'email' => 'required',
           
        ];
    }
}
