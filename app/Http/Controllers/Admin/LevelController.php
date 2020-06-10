<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    public function byProject($id)
    {
        return Level::where('project_id', $id)->get();
    }

    public function store(Level $level)
    {
        $data = request()->all();
        Level::validation($data);
        Level::create($data);

        return back()->with('notification', 'El Nivel de ha creado exitosamente');
    }

    public function update(Level $level)
    {
        $data = request()->all();
        Level::validation($data);
        $level = Level::find($data['level_id']);
        $level->update($data);
        return back()->with('notification', 'La categoria se editó  exitosamente');
    }

    public function delete(Level $level)
    {
        $level->delete();
        return back()->with('notification', 'El nivel se eliminó  exitosamente');
    }

}
