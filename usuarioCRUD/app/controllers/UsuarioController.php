<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends \BaseController {

	public function index()
    {
        $usuarios = Usuario::all();
        return View::make('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return View::make('usuarios.create');
    }

    public function store()
    {
        $input = Input::all();

        // Encriptar la contraseña antes de crear el usuario
        $input['contrasenha'] = Hash::make($input['contrasenha']);
        Usuario::create($input);
        return Redirect::route('usuarios.index');
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return View::make('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return View::make('usuarios.edit', compact('usuario'));
    }

    public function update($id)
    {
    $usuario = Usuario::findOrFail($id);
    $data = Input::all();

    // Validar los datos del formulario
    $rules = [
        'apodo' => 'required',
        
    ];

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }

    // Actualizar el apodo
    $usuario->apodo = $data['apodo'];

    // Verificar la contraseña actual y actualizar la nueva contraseña si se proporciona
    if (!empty($data['new_password'])) {
        //Se usa Hash para encriptar la contrasenha
        if (Hash::check($data['current_password'], $usuario->contrasenha)) {
            $usuario->contrasenha = Hash::make($data['new_password']);
        } else {
            return Redirect::back()->withErrors(['current_password' => 'La contraseña actual es incorrecta'])->withInput();
        }
    }

    $usuario->save();

    return Redirect::route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return Redirect::route('usuarios.index');
    }


}
