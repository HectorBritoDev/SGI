@extends('layouts.app')

@section('content')

<div class="card border-primary">
    <div class="card-header bg-primary text-light">Registrar incidencia</div>
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
        <form action="{{ url('/proyectos') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                </div>

                <div class="form-group">
                    <label for="date">Fecha de inicio</label>
                    <input type="date" class="form-control" name="date" value="{{ old('date', date('Y-m-d'))}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Registrar Proyecto</button>
                </div>

            </fieldset>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Fecha Inicio</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start ?: 'No se ha indicado' }}</td>
                    <td>
                        @if ($project->trashed())
                        <a href='{{ route('project.restore', $project)  }}' class="btn btn-sm btn-danger" title="Restaurar">
                            <i class="fas fa-retweet"></i>
                        </a>
                        @else
                        <a href="{{ route('project.edit', $project) }}" class="btn btn-sm btn-primary" title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href='{{ url("/proyectos/{$project->id}/eliminar") }}' class="btn btn-sm btn-danger" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>

</div>

@endsection
