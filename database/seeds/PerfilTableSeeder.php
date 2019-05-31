<?php

use Illuminate\Database\Seeder;
use App\Models\Perfil;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
          'name' => 'Admin',
          'description' => 'Administrador do sistema'
        ]);
    }
}
