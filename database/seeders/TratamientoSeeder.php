<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Generar 10 tratamientos
        \App\Models\Tratamiento::create(
            ['nombre' => 'Aspirina',
            'observaciones' => 'Paciente con dolor de cabeza',
            'duracion' => '7',
            'tratamiento' => 'Tomar 1 pastilla cada 8 horas'
            ] );
        \App\Models\Tratamiento::create(
            ['nombre' => 'Ibuprofeno',
            'observaciones' => 'Paciente con dolor de cabeza',
            'duracion' => '7',
            'tratamiento' => 'Tomar 1 pastilla cada 8 horas'
            ] );
        \App\Models\Tratamiento::create(
            ['nombre' => 'Paracetamol',
            'observaciones' => 'Paciente con dolor de cabeza',
            'duracion' => '7',
            'tratamiento' => 'Tomar 1 pastilla cada 8 horas'
            ] );
        \App\Models\Tratamiento::create(
            ['nombre' => 'Amoxicilina',
            'observaciones' => 'Paciente con infección de garganta',
            'duracion' => '7',
            'tratamiento' => 'Tomar 1 pastilla cada 8 horas'
            ] );
        \App\Models\Tratamiento::create(
            ['nombre' => 'Ibuprofeno',
            'observaciones' => 'Paciente con infección de garganta',
            'duracion' => '7',
            'tratamiento' => 'Tomar 1 pastilla cada 8 horas'
            ] );
        \App\Models\Tratamiento::create(
            ['nombre' => 'Paracetamol',
            'observaciones' => 'Paciente con infección de garganta',
            'duracion' => '7',
            'tratamiento' => 'Tomar 1 pastilla cada 8 horas'
            ] );
    }
}
