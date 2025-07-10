<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\StoreUsuarioRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('role')->latest()->paginate(10);
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Busca todos os papéis disponíveis para mostrar no formulário
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(StoreUsuarioRequest $request)
    {
        $dadosValidados = $request->validated();

        User::create([
            'name' => $dadosValidados['name'],
            'email' => $dadosValidados['email'],
            'password' => Hash::make($dadosValidados['password']),
            'role_id' => $dadosValidados['role_id'], // Atribui o role_id diretamente
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->id === Auth::id()) {
            return redirect()->route('usuarios.index')
            ->with('error', 'Você não pode excluir o seu próprio usuário.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
        ->with('success', 'Usuário desativado com sucesso!');
    }
}
