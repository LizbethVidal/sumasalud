<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\AltaUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dni',
        'fecha_nac',
        'movil',
        'direccion',
        'rol',
        'tutor_id',
        'foto',
        'especialidad_id',
        'alergias',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'alergias' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            Mail::to($user->email)->send(new AltaUsuario($user));
        });
    }

    public function pacientes()
    {
        return $this->belongsToMany(User::class, 'user_doctores', 'doctor_id', 'paciente_id')
            ->withTimestamps();
    }

    public function doctores()
    {
        return $this->belongsToMany(User::class, 'user_doctores', 'paciente_id', 'doctor_id')
            ->withTimestamps();
    }

    public function doctor_principal()
    {
        return $this->belongsToMany(User::class, 'user_doctores', 'paciente_id', 'doctor_id')
            ->wherePivot('doctor_principal', 1)
            ->withTimestamps()->first();
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function citas_paciente()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }

    public function citas_doctor()
    {
        return $this->hasMany(Cita::class, 'doctor_id');
    }

    public function citas_user()
    {
        return $this->hasMany(Cita::class, 'user_id');
    }

    public function consultas_paciente()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }

    public function consultas_doctor()
    {
        return $this->hasMany(Consulta::class, 'doctor_id');
    }


    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function personas_cargo()
    {
        return $this->hasMany(User::class, 'tutor_id');
    }
}
