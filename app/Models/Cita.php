<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'user_id',
        'motivo_cancelacion',
        'fecha_hora',
        'estado'
    ];


    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }


}
