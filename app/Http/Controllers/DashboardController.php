<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $search = request('search');

        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $users = User::all();
        }

        return view('admin.dashboard', compact('users', 'search', 'user'));
    }


    public function store(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Criação do novo usuário
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos do formulário
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Busca o usuário no banco de dados
        $user = User::findOrFail($id);

        // Atualização dos dados do usuário
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        // Busca o usuário no banco de dados
        $user = User::findOrFail($id);

        // Exclusão do usuário
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Usuário excluído com sucesso!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }
        
}
