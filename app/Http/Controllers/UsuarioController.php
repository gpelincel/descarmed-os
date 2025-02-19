<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Usuario;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    
    private $usuarioService;

    public function __construct(UsuarioService $usuarioService) {
        $this->usuarioService = $usuarioService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $usuarios = $this->usuarioService->getAll();
        
        if (request()->wantsJson()){
            return response()->json($usuarios);
        }

        return view('usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request) {
        $usuario = $this->usuarioService->save($request->all());

        if (request()->wantsJson()){
            return response()->json($usuario);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $usuario = $this->usuarioService->findByID($id);
        return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuarioService) {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUsuarioRequest $request, string $id) {
        $usuario = $this->usuarioService->edit($request->all(), $id);

        if (request()->wantsJson()){
            return response()->json($usuario);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Usuário atualizado com sucesso!');
    }

    public function login(Request $request){
        $usuario = $this->usuarioService->login($request->all());
        if($usuario){
            return redirect()->route('cliente');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'Usuário ou senha inválidos!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $usuario = $this->usuarioService->delete($id);
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Usuário deletado com sucesso', 'data' => $usuario], 200);
        }
        
        return redirect()->back()->with('status', 'success')->with('message','Usuário deletado com sucesso!');
    }
}
