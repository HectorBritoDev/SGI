@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Dashboard</div>
    <div class="card-body">

        @if (auth()->user()->is_support)


        {{-- ASIGANADAS A MI --}}

        <div class="card mb-3">
            <div class="card-header text-white bg-success">Incidencias asignadas a mi</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Severidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col">Titulo</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_my_incidents">
                        @foreach ($my_incidents as $incident)
                        <tr>
                            <td><a href="{{ route('incident.show', $incident->id) }}">{{ $incident->id }}</td>
                            <td>{{ $incident->category->name }}</td>
                            <td>{{ $incident->severity_full_name }}</td>
                            <td>{{ $incident->state }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td>{{ $incident->title_short }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- FIN --}}


        {{-- NO ASIGNDAS--}}

        <div class="card mb-3">
            <div class="card-header text-white bg-success">Incidencias para asignar</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Severidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col">Opcion</th>
                            <th scope="col">Titulo</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_pending_incidents">
                        @foreach ($pending_incidents as $incident)
                        <tr>
                            <td><a href="{{ route('incident.show', $incident->id) }}">{{ $incident->id }}</a>
                            </td>
                            <td>{{ $incident->category->name }}</td>
                            <td>{{ $incident->severity_full_name }}</td>
                            <td>{{ $incident->state }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td>{{ $incident->title_short }}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                            </td>
                        </tr>

                        @endforeach</tbody>
                </table>
            </div>
        </div>
        {{--FIN --}}
        @endif

        {{-- REPORTADAS POR MI --}}
        <div class="card mb-3">
            <div class="card-header text-white bg-success">Incidencias reportadas por mi</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Severidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Responsable</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_to_others">
                        @foreach ($incidents_by_me as $incident)
                        <tr>
                            <td><a href="{{ route('incident.show', $incident->id) }}">{{ $incident->id }}</td>
                            <td>{{ $incident->category->name }}</td>
                            <td>{{ $incident->severity_full_name }}</td>
                            <td>{{ $incident->state }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td>{{ $incident->title_short }}</td>
                            <td>{{ $incident->support_id  }}</td>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- FIN --}}
</div>



</div>


@endsection
