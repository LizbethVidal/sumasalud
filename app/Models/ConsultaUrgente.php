<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaUrgente extends Model
{
    use HasFactory;

    protected $table = 'consultas_urgentes';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'motivo',
        'enlace',
        'estado'
    ];


    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
