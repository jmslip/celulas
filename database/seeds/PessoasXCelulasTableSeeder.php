<?php

use Illuminate\Database\Seeder;
use App\Models\PessoasXCelulas as pc;

class PessoasXCelulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pc::create([
          'id_people' => 1,
          'id_small_group' => 1,
          'leader' => true
        ], [
          'id_people' => 2,
          'id_small_group' => 2,
          'leader' => false
        ]);
    }
}
