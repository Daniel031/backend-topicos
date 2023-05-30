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
            
            'user_id'
            'titulo' = 'required',
            'descripcion' = 'required',
            'fecha'
            'estado' // ESTADO 1 DICE PENDIENTE DE REVISION
            'hash'
            'latitud'
            'longitud'
            $table->unsignedSmallInteger('tipo_denuncia');
            $table->timestamps();
        ];
    }
}
