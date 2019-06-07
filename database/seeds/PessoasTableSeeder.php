<?php

use Illuminate\Database\Seeder;
use App\Models\Pessoas;

class PessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoas::create([
          'name' => 'Jorge',
          'lastname' => 'Marcelo de Souza Junior',
          'birthday' => '1987-05-20',
          'cellphone' => '31994773864',
          'email' => 'jms.slip@gmail.com',
          'leader' => true,
          'id_user' => 1,
          'street' => 'Rua Novo Mundo',
          'number' => 108,
          'neiborhood' => 'Novo Glória',
          'city' => 'Belo Horizonte',
          'state' => 'MG',
          'cep' => '30880320'
        ]);

        Pessoas::create([
          'name' => 'Rúbia',
          'lastname' => 'Mara de Oliveira Souza',
          'birthday' => '1987-05-20',
          'cellphone' => '31994773864',
          'email' => 'jms.slip@gmail.com',
          'leader' => true,
          'id_user' => 1,
          'street' => 'Rua Novo Mundo',
          'number' => 108,
          'neiborhood' => 'Novo Glória',
          'city' => 'Belo Horizonte',
          'state' => 'MG',
          'cep' => '30880320'
        ]);
    }
}
