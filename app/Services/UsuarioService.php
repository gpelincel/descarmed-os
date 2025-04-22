<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService {
    public function findByID(string $id) {
        return Usuario::findOrFail($id);
    }

    public function getAll() {
        return Usuario::query()->paginate(10);
    }

    public function save(array $usuario) {
        $usuario['senha'] = Hash::make($usuario['senha']);
        $usuario = Usuario::create($usuario);

        return $usuario;
    }

    public function delete(string $id) {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return $usuario;
    }

    public function edit(array $novoUsuario, string $id) {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($novoUsuario);
        return $usuario;
    }

    public function login(array $login) {
        $usuario = Usuario::where('usuario', $login['usuario'])->first();

        if ($usuario && Hash::check($login['senha'], $usuario->senha)) {
            $nomes = explode(' ', trim($usuario->nome));
            $nome_completo = implode(' ', array_slice($nomes, 0, 2));

            session(['user_id' => $usuario->id]);
            session(['username' => $nome_completo]);
            return $usuario;
        }
    }
}
