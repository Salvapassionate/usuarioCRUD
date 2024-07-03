@extends('layouts.master')

@section('content')
    <h1 class="page-header">Editar Usuario</h1>
<!--Bloque de errores muestra mensaje de alerta -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::model($usuario, ['route' => ['usuarios.update', $usuario->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'edit-user-form']) }}
        {{ Form::token() }} <!-- Token CSRF -->
        <div class="form-group">
            {{ Form::label('apodo', 'Apodo:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::text('apodo', null, ['class' => 'form-control','required' => 'required']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('current_password', 'Contraseña Actual:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::password('current_password', ['class' => 'form-control', 'id' => 'actual_contrasenha']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('new_password', 'Nueva Contraseña:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::password('new_password', ['class' => 'form-control', 'id' => 'nueva_contrasenha']) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) }}
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Cancelar</a>
            </div>
        </div>
    {{ Form::close() }}
@endsection

@section('scripts')
<script>
        $(document).ready(function() {
            $('#edit-user-form').on('submit', function(e) {
                

                // Validar contraseña
                
                var actual_contrasenha = $('#actual_contrasenha').val();
                if (actual_contrasenha.length < 6) {
                    $('#actual_contrasenha').after('<span class="error text-danger">La contraseña actual debe tener al menos 6 caracteres</span>');
                    event.preventDefault();
                }

                // Validar nueva contraseña
                var nueva_contrasenha = $('#nueva_contrasenha').val();
                if (nueva_contrasenha.length < 6) {
                    $('#nueva_contrasenha').after('<span class="error text-danger">La nueva contraseña debe tener al menos 6 caracteres</span>');
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
