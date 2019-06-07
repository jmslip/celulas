<?php

use Illuminate\Database\Seeder;
use App\Models\Celulas;

class CelulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Celulas::create([
          'name' => 'Égide',
          'Description' => 'Célula Égide',
          'street' => 'Rua Novo Mundo',
          'number' => 41,
          'neiborhood' => 'Novo Glória',
          'city' => 'Belo Horizonte',
          'state' => 'MG',
          'cep' => '30880320'
        ]);

        Celulas::create([
          'name' => 'Ágape',
          'description' => 'Célula Ágape',
          'street' => 'Rua João Donada',
          'number' => 108,
          'neiborhood' => 'Serrano',
          'city' => 'Belo Horizonte',
          'state' => 'MG',
          'cep' => '30880320'
        ]);
    }
}
