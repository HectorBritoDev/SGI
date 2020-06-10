<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProjectUser;

class ProjectUserController extends Controller
{
    public function store()
    {
        //posibles validaciones
        //asegurar que el proyecto exista
        //asegurar que el nivel exista
        //asegurar que el usuario exista

        $data = request()->all();
        //COMPROBACION DE QUE UN USUARIO NO ESTA ASIGNADO A 2 NIVELES DEL MISMO PROYECTO
        $project_user = ProjectUser::where('project_id', $data['project_id'])->where('user_id', $data['user_id'])->first();
        if ($project_user) {
            return back()->with('notification', 'El usuario ya esta asignado a este proyecto');
        } else {
            ProjectUser::create($data);
            return back()->with('notification', 'El proyecto se ha asignado correctamente');
        }
    }

    public function update(ProjectUser $projectUser)
    {

    }

    public function delete(ProjectUser $project_user)
    {
        $project_user->delete();
        return back()->with('notification', 'Se ha elimiando correctamente');
    }

}
