<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'observaciones',
        'tratamiento'
    ];

    public function paciente(){
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
