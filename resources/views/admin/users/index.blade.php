@extends('layouts.app')

@section('content')

<div class="card border-primary">
    <div class="card-header bg-primary text-light">Registrar Usuario</div>
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
        <form action="{{ url('/usuarios') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" value="{{ old('password',str_random(6)) }}">
                </div>




                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Registrar</button>
                </div>

            </fieldset>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="{{ route('supportUser.edit', $user) }}" class="btn btn-sm btn-primary" title="Editar">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <a href='{{ url("/usuario/{$user->id}/eliminar") }}' class="btn btn-sm btn-danger" title="Eliminar">
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
