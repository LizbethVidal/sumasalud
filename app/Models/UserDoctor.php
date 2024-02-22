<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDoctor extends Model
{
    use HasFactory;

    protected $table = 'user_doctores';

    protected $fillable = [
        'paciente_id',
        'doctor_id'
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
