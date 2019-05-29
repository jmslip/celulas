<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jorge Marcelo',
            'email' => 'jms.slip@gmail.com',
            'password' => bcrypt('iron20Slip'),
            'id_profile' => 1
        ]);
    }
}
