<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Generar 10 especialidades
        Especialidad::create(['nombre' => 'Cardiología']);
        Especialidad::create(['nombre' => 'Neumología']);
        Especialidad::create(['nombre' => 'Oncología']);
        Especialidad::create(['nombre' => 'Pediatría']);
        Especialidad::create(['nombre' => 'Psiquiatría']);
        Especialidad::create(['nombre' => 'Traumatología']);
        Especialidad::create(['nombre' => 'Urología']);
        Especialidad::create(['nombre' => 'Ginecología']);
        Especialidad::create(['nombre' => 'Dermatología']);
        Especialidad::create(['nombre' => 'Oftalmología']);
        Especialidad::create(['nombre' => 'General']);
    }
}
