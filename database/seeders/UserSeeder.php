<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Genear 1 usuario admin por defecto
        \App\Models\User::create(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'rol' => 'admin',
            ]
            );

        //Generar 10 usuarios doctores

        \App\Models\User::factory(10)->create([
            'rol' => 'doctor',
            'especialidad_id' => \App\Models\Especialidad::all()->random()->id
        ]);

        //Generar 10 usuarios pacientes
        \App\Models\User::factory(10)->create([
            'rol' => 'paciente',
        ]);
    }
}
