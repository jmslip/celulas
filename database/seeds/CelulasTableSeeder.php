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
          'id_address' => 1
        ], [
          'name' => 'Ágape',
          'description' => 'Célula Ágape',
          'id_address' => 2
        ]);
    }
}
