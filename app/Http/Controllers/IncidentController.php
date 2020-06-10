<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use App\Level;
use App\ProjectUser;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $categories = Category::where('project_id', 1)->get();
        return view('incidents.create', compact('categories'));
    }

    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        $messages = $incident->messages;
        return view('incidents.show', compact('incident', 'messages'));
    }

    public function store()
    {

        $data = request()->all();
        $data = Incident::validation($data);
        $user = auth()->user();

        //dd(Project::find($user->selected_project_id)->first_level_id); NO PUDE HACERLO FUNCIONAR

        $incident = Incident::create([
            'category_id' => $data['category_id'],
            'severity' => $data['severity'],
            'title' => $data['title'],
            'description' => $data['description'],

        ]);

        $incident->project_id = $user->selected_project_id;
        $incident->client_id = $user->id;
        $incident->level_id = Level::where('project_id', $user->selected_project_id)->first()->id;

        $incident->save();

        return redirect()->route('incident.show', [$incident->id]);

    }

    public function edit(Incident $incident)
    {
        $categories = $incident->project->categories;

        return view('incidents.edit', compact('incident', 'categories'));
    }

    public function update(Incident $incident)
    {
        $data = request()->all();
        $data = Incident::validation($data);
        $incident->update($data);

        return redirect()->route('incident.show', $incident->id);

    }
    public function open(Incident $incident)
    {
        //Es el cliente el que esta cerrando la incidencia?
        if ($incident->client_id == auth()->user()->id) {
            $incident->active = 1;
            $incident->save();

        }
        return back();
    }

    public function take(Incident $incident)
    {
        $user = auth()->user();

        if (!$user->is_support) {
            return back();
        }

        //Existe una relacion entre el projecto y el usuario?
        $project_user = ProjectUser::where('project_id', $incident->project_id)->where('user_id', $user->id)->first();
        if (!$project_user) {
            return back();
        }

        // El nivel es el mismo?
        if ($project_user->level_id != $incident->level_id) {
            return back();
        }

        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }

    public function solve(Incident $incident)
    {
        //Es el cliente el que esta cerrando la incidencia?
        if ($incident->client_id == auth()->user()->id) {
            $incident->active = 0;
            $incident->save();

        }
        return back();
    }
    public function nextLevel(Incident $incident)
    {
        $project = $incident->project;
        $levels = $project->levels;
        $level_id = $incident->level_id;

        $next_level_id = $this->getNextLevelId($level_id, $levels);

        if ($next_level_id) {
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();
            return back();
        }
        return back()->with('notification', 'No es posible derivar porque no hay un siguiente nivel');

    }

    public function getNextLevelId($level_id, $levels)
    {
        if (sizeof($levels) <= 1) {
            return null;
        }

        $position = -1;
        for ($i = 0; $i < sizeof($levels) - 1; $i++) {
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }

        if ($position == -1) {
            return null;
        }

        // if ($position == sizeof($levels) - 1) {
        //     return
        // }

        return $levels[$position + 1]->id;
    }
}
