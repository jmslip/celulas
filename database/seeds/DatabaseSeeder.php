<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          PerfilTableSeeder::class,
          UsersTableSeeder::class,
          EnderecosTableSeeder::class,
          CelulasTableSeeder::class,
          PessoasTableSeeder::class,
          PessoasXCelulasTableSeeder::class
        ]);
    }
}
