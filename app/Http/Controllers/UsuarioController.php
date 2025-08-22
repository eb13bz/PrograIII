<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id_usuario', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'usuario' => 'required|unique:usuarios,usuario',
            'contrasena' => 'required'
        ]);
        Usuario::create($request->all());
        return redirect()->route('usuarios.index');
    }

    public function show(Usuario $usuario)
    {
        // Vista para un solo usuario
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required',
            'usuario' => 'required|unique:usuarios,usuario,' . $usuario->id_usuario . ',id_usuario',
            'contrasena' => 'required'
        ]);
        $usuario->update($request->all());
        return redirect()->route('usuarios.index');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}