@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Usuario: {{ $usuario->apodo }}</h3>
        </div>
        <div class="panel-body">
            <p><strong>Apodo:</strong> {{ $usuario->apodo }}</p>
            <p><strong>Contraseña:</strong> {{ $usuario->contrasenha }}</p>
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
@endsection

