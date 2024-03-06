<?php

namespace App\Models;

use App\Mail\UpdateCita;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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


    public static function booted()
    {
        static::updated(function ($cita) {
            if ($cita->isDirty('estado')) {
                if ($cita->estado == 'CANCELADA') {
                    Mail::to($cita->paciente->email)->send(new UpdateCita($cita, 'Cita cancelada'));
                }

                if ($cita->estado == 'ATENDIDA') {
                    Mail::to($cita->paciente->email)->send(new UpdateCita($cita, 'Cita atendida'));
                }
            }
        });
    }

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

    public function fechaCita(){
        return Carbon::parse($this->fecha_hora)->format('d/m/Y H:i');
    }
}
