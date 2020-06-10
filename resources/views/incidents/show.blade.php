@extends('layouts.app')

@section('content')

<div class="card border-primary">
    <div class="card-header bg-primary text-light">Registrar incidencia</div>
    {{-- Inicio --}}
    <div class="card-body">
        {{-- @if($errors->any())
        <div class="alert alert-danger">
            <h3 class="alert-heading">Corrige estos errores para continuar</h3>
            <ul>
                @foreach($errors->all() as $errors)
                <li>{{ $errors }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}
    @if(session('notification'))
    <div class="alert alert-danger">
        {{ session('notification') }}

    </div>
    @endif




    <div class="card-body">

        {{-- DETALLES --}}
        <table class="table table-bordered">

            {{-- 1ER HEAD --}}
            <thead class="thead-dark">
                <tr>
                    <th>Código</th>
                    <th>Proyecto</th>
                    <th>Categoría</th>
                    <th>Fecha de Envío</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $incident->id }}</td>
                    <td>{{ $incident->project->name }}</td>
                    <td>{{ $incident->category->name }}</td>
                    <td>{{ $incident->created_at }}</td>
                </tr>

            </tbody>

            {{-- 2DO HEAD --}}
            <thead class="thead-dark">
                <tr>
                    <th>Asignada a</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th>Severidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $incident->support_name }}</td>
                    <td>{{ $incident->level->name }}</td>
                    <td>{{ $incident->state }}</td>
                    <td>{{ $incident->severity_full_name }}</td>
                </tr>
            </tbody>
        </table>
        {{-- FIN --}}

        {{-- DATOS BASICOS --}}
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Título</th>
                    <td>{{ $incident->title }}</td>
                </tr>
                <tr>
                    <th>Descripcion</th>
                    <td>{{ $incident->description }}</td>
                </tr>
                <tr>
                    <th>Adjuntos</th>
                    <td>No hay archivos adjuntos></td>
                </tr>
            </tbody>
        </table>
        {{-- FIN --}}

        @if ($incident->support_id == null && $incident->active && auth()->user()->canTake($incident))
        <a href="{{ route('incident.take',$incident) }}" class="btn btn-sm btn-primary">Atender Incidencia</a>
        @endif

        @if (auth()->user()->id == $incident->client_id)

        @if ($incident->active)
        <a href="{{ route('incident.solve',$incident) }}" class="btn btn-sm btn-info">Marcar como resuelto</a>
        <a href="{{ route('incident.edit',$incident) }}" class="btn btn-sm btn-warning">Editar incidencia</a>
        @else
        <a href="{{ route('incident.open',$incident) }}" class="btn btn-sm btn-success">Volver a abrir
            incidencia</a>
        @endif

        @endif


        @if (auth()->user()->id == $incident->support_id && $incident->active)
        <a href="{{ route('incident.nextLevel',$incident) }}" class="btn btn-sm btn-danger">Derivar al
            siguiente
            nivel</a>
        @endif


    </div>
</div>

</div>

@include('layouts.chat')


@endsection
