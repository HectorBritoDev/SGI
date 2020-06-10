<div class="card border-primary">
    <div class="card-header bg-primary text-light">Menú</div>
    <div class="card-body flex">

        <ul class="nav nav-pills flex-column">
            @if(auth()->check())
            <li class="nav-item">
                <a @if (request()->is('home')) class="nav-link active" @endif
                    class="nav-link" href="{{ route('home') }}">Dashboard</a>

                <a @if (request()->is('reportar')) class="nav-link active" @endif
                    class="nav-link" href="{{ route('report') }}">Reportar incidencia</a>

                @if(auth()->user()->is_admin)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Administracion</a>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <a class="dropdown-item" href="{{ route('supportUser.create') }}">Usuarios</a>
                    <a class="dropdown-item" href="{{ route('project.create') }}">Proyectos</a>
                </div>
            </li>
            @endif

            @else

            <a class="nav-link" href="#">Bienvenido</a>
            <a class="nav-link" href="#">Instrucciones</a></a>
            <a class="nav-link" href="#">Créditos</a>
            </li>
            @endif
        </ul>

    </div>
</div>
