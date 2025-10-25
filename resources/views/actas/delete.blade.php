@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="center-align red-text">Eliminar Acta JRV {{ $acta->jrv }}</h4>

    <div class="card red lighten-5">
        <div class="card-content">
            <p><strong>Municipio:</strong> {{ $acta->municipio->nombre ?? '-' }}</p>
            <p><strong>Centro de Votación:</strong> {{ $acta->centro->nombre ?? '-' }}</p>
            <p><strong>Observaciones:</strong> {{ $acta->observaciones ?? '-' }}</p>
            <p><strong>Creada:</strong> {{ $acta->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <form action="{{ route('actas.destroy', $acta->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="center-align">
            <p class="red-text">¿Está seguro de que desea eliminar esta acta? Esta acción no se puede deshacer.</p>
            <button type="submit" class="btn red">
                <i class="material-icons left">delete</i> Eliminar
            </button>
            <a href="{{ route('actas.listar') }}" class="btn grey">
                <i class="material-icons left">cancel</i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
