<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'especialidad_id',
        'descripcion',
        'prioridad',
        'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id', 'id');
    }

}
