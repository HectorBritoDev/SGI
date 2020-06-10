<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ROLES 0= ADMIN 1 = SUPPORT 2=CLIENT

        //Admin 0
        User::create([
            'name' => 'Hector',
            'email' => 'hector@dev.com',
            'password' => bcrypt('123456'),
            'role' => 0,
        ]);

        //Client 2
        User::create([
            'name' => 'Pedro',
            'email' => 'client@dev.com',
            'password' => bcrypt('123456'),
            'role' => 2,
        ]);
    }
}
