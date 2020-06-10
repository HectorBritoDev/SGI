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
        <form action="{{ url("/proyectos/{$project->id}") }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $project->name) }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description', $project->description) }}">
                </div>
                <div class="form-group">
                    <label for="date">Fecha de inicio</label>
                    <input type="date" class="form-control" name="date" value="{{ old('date', $project->start)}}">
                </div>
                <div class=" form-group">
                    <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
                </div>
            </fieldset>
        </form>

        {{-- -TABLAS CATEGORIAS Y NIVELES --}}
        <div class="row">

            {{-- INICIO TABLA CATEGORIAS --}}
            <div class="col-md-6">
                <p>Categorias</p>
                <form action="{{ url('/categorias')}}" method="POST" class="form-inline">
                    @csrf
                    <fieldset>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="text" class="form-control mb-2" name="name" placeholder="Ingrese Nombre">
                        <button type="submit" class="btn btn-success mb-2"> Añadir</button>
                    </fieldset>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-category="{{ $category->id }}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <a href="{{ route('category.delete', $category) }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FIN TABLA CATEGORIAS --}}


            {{-- INICIO TABLA NIVELES --}}
            <div class="col-md-6">
                <p>Niveles</p>
                <form action="{{ url('/niveles')}}" method="POST" class="form-inline">
                    @csrf
                    <fieldset>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="text" class="form-control mb-2" name="name" placeholder="Ingrese Nombre">
                        <button type="submit" class="btn btn-warning mb-2"> Añadir</button>
                    </fieldset>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nivel</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($levels as $key => $level)
                        <tr>
                            <td>N{{ $key+1 }}</td>
                            <td>{{ $level->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-level="{{ $level->id }}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <a href="{{ route('level.delete', $level) }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- FIN TABLA NIVELES --}}
        </div>


    </div>

</div>

{{-- -MODAL PARA CATEGORIA --}}
<div class="modal" tabindex="-1" role="dialog" id="modalEditCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Categoria</h5> {{-- -TITULO DEL MODAL --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('category.edit') }}" method="POST"> {{-- -FORMULARIO --}}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="category_id" id="category_id" value="">
                    <div class="form-group">
                        <label for="name">Nombre de la categoria</label>
                        <input type="text" class="form-control" id="category_name" name="name" value="">
                    </div>
                </div>
                <div class="modal-footer"> {{-- -PIE DEL MODAL --}}
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- -MODAL PARA NIVELES --}}
<div class="modal" tabindex="-1" role="dialog" id="modalEditLevel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Nivel</h5> {{-- -TITULO DEL MODAL --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('level.edit') }}" method="POST"> {{-- -FORMULARIO --}}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="level_id" id="level_id" value="">
                    <div class="form-group">
                        <label for="name">Nombre del nivel</label>
                        <input type="text" class="form-control" id="level_name" name="name" value="">
                    </div>
                </div>
                <div class="modal-footer"> {{-- -PIE DEL MODAL --}}
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/admin/projects/edit.js" defer></script>
@endsection
