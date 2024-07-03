@extends('layouts.master')

@section('content')
    <h1 class="page-header">Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear Usuario</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Apodo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->apodo }}</td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
                        {{ Form::open(['route' => ['usuarios.destroy', $usuario->id], 'method' => 'DELETE', 'style' => 'display:inline-block;', 'class' => 'delete-form']) }}
                            {{ Form::token() }} <!-- Token CSRF -->
                            {{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-form').on('submit', function() {
                return confirm('¿Estás seguro de que deseas eliminar este usuario?');
            });
        });
    </script>
@endsection
