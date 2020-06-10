<br>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Discusion</h5>
    </div>

    <div class="card-body">
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <h3 class="alert-heading">Corrige estos errores para continuar</h3>
            <ul>
                @foreach($errors->all() as $errors)
                <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <ul class="list-unstyled">
            @foreach ($messages as $message)


            <li class="media">

                <img class="mr-3" src="{{ $message->user->avatar_path }}">
                <div class="media-body">

                    {{ $message->message }}
                    <br>
                    <small class="text-muted">{{ $message->user->name }} | {{ $message->created_at }}</small>
                    <hr>
                </div>
            </li>
            @endforeach

        </ul>
    </div>
    <div class="card-footer">

        <form action="/mensajes" method="POST">
            @csrf
            <div class="input-group">
                <input type="hidden" name="incident_id" value="{{ $incident->id }}">
                <input type="text" class="form-control" name="message">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Enviar</button>
                </span>
            </div>
        </form>

    </div>
</div>
