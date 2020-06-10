<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create( //ID 1
            [
                'name' => 'Atención por teléfono',
                'project_id' => 1,
            ]
        );
        Level::create( //ID 2
            [
                'name' => 'Envío de técnico',
                'project_id' => 1,
            ]
        );
        Level::create( //ID 3
            [
                'name' => 'Mesa de ayuda',
                'project_id' => 2,
            ]
        );

        Level::create( //ID 4
            [
                'name' => 'Consulta especializada',
                'project_id' => 2,
            ]
        );
    }

}
