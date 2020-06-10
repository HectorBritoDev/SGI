<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectUser;
use App\User;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(User $user)
    {
        $users = User::where('role', 1)->get();
        return view('admin.users.index', compact('users'));
    }

    public function store() // CREATE

    {
        $data = request()->validate(
            [
                'email' => 'required|email|max:255|unique:users',
                'name' => 'required|min:2|max:255',
                'password' => 'required|min:6',

            ],
            [
                'email.required' => 'Debes colocar un email',
                'email.email' => 'Debes colocar un email valido',
                'email.max' => 'El email no puede ser tan largo',
                'email.unique' => "El email ya esta registrado",
                'name.required' => 'Debes colocar un nombre',
                'name.min' => 'El nombre no puede ser tan corto',
                'name.max' => 'El nombre no puede ser tan largo',
                'password.required' => 'Debes colocar una contraseña',
                'password.min' => 'La contraseña debe tener al menos 6 digitos',
            ]
        );

        $user = User::create(
            [

                'email' => $data['email'],
                'name' => $data['name'],
                'password' => bcrypt($data['password']),

            ]

        );

        $user->role = 1;
        $user->save();
        return back()->with('notification', 'Usuario registrado exitosamente');
    }

    public function edit(User $user)
    {
        $user = User::find($user->id);
        $projects = Project::all();
        $projects_user = ProjectUser::where('user_id', $user->id)->get();
        return view('admin.users.edit')->with(compact('user', 'projects', 'projects_user'));
    }

    public function update(User $user) //UPDATE

    {
        $user = User::find($user->id);

        $data = request()->validate(
            [
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'name' => 'required|min:2|max:255',
                'password' => '',
            ],
            [
                'email.required' => 'Debes colocar un email',
                'email.email' => 'Debes colocar un email valido',
                'email.max' => 'El email no puede ser tan largo',
                'email.unique' => "El email ya esta registrado por otro usuario",
                'name.required' => 'Debes colocar un nombre',
                'name.min' => 'El nombre no puede ser tan corto',
                'name.max' => 'El nombre no puede ser tan largo',
                'password.min' => 'La contraseña debe tener al menos 6 digitos',
            ]
        );

        if ($data['password'] != null) {
            $data = request()->validate([
                'name' => '',
                'email' => '',
                'password' => 'min:6',
            ],
                [
                    'password.min' => 'La contraseña tiene que tener al menos 6 caracteres',
                ]);

            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return back()->with('notification', 'Actualizado correctamente');
    }

    public function delete(User $user)
    {
        $user->delete();
        return back()->with('notification', 'El usuario se ha eliminado correctamente');
    }
}
