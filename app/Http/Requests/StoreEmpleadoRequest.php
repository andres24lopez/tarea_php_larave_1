<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => ['required', 'string', 'regex:/^[A-Za-z0-9-]{2,10}$/', 'unique:empleados,codigo'],
            'nombres' => ['required', 'string', 'regex:/^[A-Za-zÁÉÍÓÚÜáéíóúüñÑ\s\'\-]+$/u'],
            'apellidos' => ['required', 'string', 'regex:/^[A-Za-zÁÉÍÓÚÜáéíóúüñÑ\s\'\-]+$/u'],
            'direccion' => ['nullable', 'string', 'max:100'],
            'telefono' => ['nullable', 'string', 'regex:/^\d{8}$/'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:today'],
            'id_puesto' => ['required', 'exists:puestos,id_puesto'],
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del empleado es obligatorio.',
            'codigo.regex' => 'El código debe tener entre 2 y 10 caracteres válidos.',
            'codigo.unique' => 'El código ingresado ya existe.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'nombres.regex' => 'Los nombres solo admiten letras, espacios, apóstrofos y guiones.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.regex' => 'Los apellidos solo admiten letras, espacios, apóstrofos y guiones.',
            'telefono.regex' => 'El teléfono debe tener 8 dígitos.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',
            'id_puesto.required' => 'Debe seleccionar un puesto válido.',
            'id_puesto.exists' => 'El puesto seleccionado no existe.',
        ];
    }
}
