@extends('layouts.app')

@section('content')

<div class="card border-primary">
    <div class="card-header bg-primary text-light">Editar Usuario</div>
    {{-- Inicio --}}
    <div class="card-body">
        @if(session('notification'))
        <div class="alert alert-success">
            {{ session('notification') }}

        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <h3 class="alert-heading">Corrige estos errores para continuar</h3>
            <ul>
                @foreach($errors->all() as $errors)
                <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ url("/usuario/{$user->id}") }}" method="POST">
            @csrf
            <fieldset>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                </div>
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label for="password">Password <em>Ingresar solo si se desea modificar</em> </label>
                    <input type="text" class="form-control" name="password">
                </div>

                <div class=" form-group">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </fieldset>
        </form>

        {{-- -Formulario de asignación --}}
        {{-- <div>
            <form action="" method="POST" class="form-inline">
                @csrf
                <fieldset>
                    <div class=" ">
                        <select name="" id="" class="form-control mb-2 mr-sm-2">
                            <option value="">Seleccion Proyecto</option>
                        </select>


                        <select name="" id="" class="form-control mb-2 mr-sm-2">
                            <option value="">Seleccione Nivel</option>
                        </select>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success  mb-2 mr-sm-2">Asignar Proyecto</button>
            </form>
        </div> --}}


        <div class="row form-group">
            <form action="{{ route('projectUser.create') }}" class="form-inline" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                {{-- Inicio -Selector de Proyecto --}}
                <div class="col-auto">
                    <select name="project_id" id="select_project" class="form-control">
                        <option value="">Seleccione Proyecto</option>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- FIN -Selector de Proyecto --}}

                {{-- INICIO - Selector de Nivel --}}
                <div class="col-auto">

                    <select name="level_id" id="select_level" class="form-control">
                        <option value="">Seleccione Nivel</option>
                    </select>
                </div>
                {{-- FIN - Selector de Nivel --}}
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Asignar</button>
                </div>
            </form>

        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Nivel</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects_user as $project_user)
                <tr>
                    <td>{{ $project_user->project->name }}</td>
                    <td>{{ $project_user->level->name }}</td>
                    <td>

                        <a href="{{ route('projectUser.delete', $project_user) }}" class="btn btn-sm btn-danger" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection

@section('scripts')
<script src="/js/admin/users/edit.js" defer></script>
@endsection
