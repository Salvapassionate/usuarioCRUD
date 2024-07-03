@extends('layouts.master')

@section('content')
    <h1 class="page-header">Crear Usuario</h1>

    {{ Form::open(['route' => 'usuarios.store', 'class' => 'form-horizontal', 'id' => 'usuario-form']) }}
        {{ Form::token() }} <!-- Token CSRF -->
        <div class="form-group">
            {{ Form::label('apodo', 'Apodo:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::text('apodo', null, ['class' => 'form-control', 'id' => 'apodo']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('contrasenha', 'Contraseña:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::password('contrasenha', ['class' => 'form-control', 'id' => 'contrasenha']) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Crear Usuario', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
 @endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#usuario-form').submit(function(event) {
                // Borrar mensajes de error anteriores
                $('.error').remove();

                // Validar apodo
                var apodo = $('#apodo').val();
                if (apodo === '') {
                    $('#apodo').after('<span class="error text-danger">Este campo es obligatorio</span>');
                    event.preventDefault();
                }

                // Validar contrasenha
                var contrasenha = $('#contrasenha').val();
                if (contrasenha === '') {
                    $('#contrasenha').after('<span class="error text-danger">Este campo es obligatorio</span>');
                    event.preventDefault();
                } else if (contrasenha.length < 6) {
                    $('#contrasenha').after('<span class="error text-danger">La contraseña debe tener al menos 6 caracteres</span>');
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
