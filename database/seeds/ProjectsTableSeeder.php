<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'Proyecto A',
            'description' => 'El Proyecto A consiste en desarrollar un sition web moderno',
        ]);

        Project::create([
            'name' => 'Proyecto B',
            'description' => 'El Proyecto B consiste en desarrollar una aplicacion android',
        ]);
    }
}
