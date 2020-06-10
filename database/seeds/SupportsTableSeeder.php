<?php

use App\User;
use Illuminate\Database\Seeder;

class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Support 1 // ID = 3
        User::create([
            'name' => 'Soporte S1',
            'email' => 'support@dev.com',
            'password' => bcrypt('123456'),
            'role' => 1,
        ]);
        //Support 2 //ID = 4
        User::create([
            'name' => 'Soporte S2',
            'email' => 'support2@dev.com',
            'password' => bcrypt('123456'),
            'role' => 1,
        ]);

    }

}
