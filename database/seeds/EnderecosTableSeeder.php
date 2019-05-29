<?php

use Illuminate\Database\Seeder;
use App\Models\Enderecos;

class EnderecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enderecos::create([
          'street' => 'Rua Novo Mundo',
          'number' => 41,
          'neiborhood' => 'Novo Glória',
          'city' => 'Belo Horizonte',
          'state' => 'MG',
          'cep' => '30880320'
        ], [
          'street' => 'Rua João Donada',
          'number' => 108,
          'neiborhood' => 'Serrano',
          'city' => 'Belo Horizonte',
          'state' => 'MG',
          'cep' => '30880320'
        ]);
    }
}
