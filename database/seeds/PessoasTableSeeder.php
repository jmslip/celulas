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
          'name' => 'Jorge Marcelo de Souza Junior',
          'birthday' => '1987-05-20',
          'cellphone' => '31994773864',
          'email' => 'jms.slip@gmail.com',
          'leader' => true,
          'id_user' => 1,
          'id_address' => 1
        ]);
    }
}
