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

        <form action='{{ url("/incidencia/$incident->id/editar") }}' method="POST">
            @csrf
            <fieldset>
                <div class="form-group">
                    <label for="category_id">Categoría</label>
                    <select class="form-control" name="category_id">
                        <option value="">General</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if ($incident->category_id == $category->id) selected
                            @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="severity">Severidad</label>
                    <select class="form-control" name="severity">
                        <option value="M" @if ($incident->severity == 'M') selected @endif>Menor</option>
                        <option value="N" @if ($incident->severity == 'N') selected @endif>Normal</option>
                        <option value="A" @if ($incident->severity == 'A') selected @endif>Alta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title',$incident->title) }}">
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" name="description">{{ old('description',$incident->description) }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Guardar Cambios </button>
                </div>

            </fieldset>
        </form>
    </div>

</div>
</div>
</div>
</div>


@endsection
