<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;


    protected $table = 'consultas';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'observaciones_paciente',
        'diagnostico',
        'tratamiento_id',
        'cita_id'
    ];

    public function paciente(){
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function tratamiento(){
        return $this->belongsTo(Tratamiento::class, 'tratamiento_id');
    }

    public function cita(){
        return $this->belongsTo(Cita::class, 'cita_id');
    }
}
