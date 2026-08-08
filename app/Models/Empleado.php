<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'fecha_nacimiento',
        'id_puesto',
    ];

    public function getRouteKeyName(): string
    {
        return 'id_empleado';
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto', 'id_puesto');
    }
}
