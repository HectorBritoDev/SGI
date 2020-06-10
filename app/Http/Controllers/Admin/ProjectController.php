<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{

    public function index(Project $projects)
    {
        $projects = Project::withTrashed()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Project $project)
    {
        $data = request()->all();

        Project::validation($data);

        Project::create(
            [

                'name' => $data['name'],
                'description' => $data['description'],
                'start' => $data['date'],
            ]
        );
        return back()->with('notification', 'Proyecto registrado exitosamente');
    }

    public function edit(Project $project)
    {
        $project = Project::find($project->id);

        // Esta forma de llamar a los datos por ID solo es posible si ya hay relaciones establecidas en los PROVIDERS
        $categories = $project->categories;
        $levels = $project->levels; //Si no hay relaciones usar Level::where('proyect_id,$project->id)->get();

        return view('admin.projects.edit', compact('project', 'categories', 'levels'));
    }

    public function update(Project $project)
    {
        $data = request()->all();
        Project::validation($data);
        $project = Project::find($project->id);

        if ($data['description'] != null) {
            $data = request()->validate(
                [
                    'name' => '',
                    'date' => '',
                    'description' => 'required| min:6 | max:255',
                ],
                [
                    'description.required' => 'Debes colocar una description',
                    'description.min' => 'La descripcion es muy corta',
                    'description.max' => 'La descripcion es muy larga',
                ]);

            $data['description'] = $data['description'];
        } else {
            unset($data['description']);
        }

        $project->update($data);
        return back()->with('notification', 'Proyecto editado exitosamente');

    }

    public function delete(Project $project)
    {
        $project->delete();
        return back()->with('notification', 'El Proyecto se ha eliminado correctamente');
    }

    public function restore(Project $project)
    {
        $project->withTrashed()->restore();
        return back()->with('notification', 'El Proyecto se ha restaurado correctamente');
    }
}
