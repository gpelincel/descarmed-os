<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Http\Requests\StoreOrdemServicoRequest;
use App\Http\Resources\OrdemServicoResource;
use App\Services\ClassificacaoOSService;
use App\Services\ClienteService;
use App\Services\OrdemServicoService;
use App\Services\StatusOSService;
use App\Services\UnidadeService;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller {

    private $osService;
    private $clienteService;
    private $statusService;
    private $classificacaoService;
    private $unidadeService;

    public function __construct(OrdemServicoService $osService, ClienteService $clienteService, StatusOSService $statusService, ClassificacaoOSService $classificacaoService, UnidadeService $unidadeService) {
        $this->osService = $osService;
        $this->clienteService = $clienteService;
        $this->statusService = $statusService;
        $this->classificacaoService = $classificacaoService;
        $this->unidadeService = $unidadeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $search = request('search');
        $field = request('field', 'titulo'); // Valor padrão: 'titulo'
        $id_status = request('id_status');
        $data_minima = request('data_inicio');

        // Campos permitidos
        $allowedFields = ['titulo', 'cliente', 'equipamento'];
        if (!in_array($field, $allowedFields)) {
            $field = 'titulo';
        }

        $ordens = $this->osService->getAll()
            ->when($search, function ($query) use ($search, $field) {
                switch ($field) {
                    case 'cliente':
                        return $query->whereHas('cliente', function ($q) use ($search) {
                            $q->where('nome', 'like', "%$search%");
                        });
                    case 'equipamento':
                        return $query->whereHas('equipamento', function ($q) use ($search) {
                            $q->where('nome', 'like', "%$search%");
                        });
                    default:
                        return $query->where($field, 'like', "%$search%");
                }
            })
            ->when($id_status && $id_status != 0, function ($query) use ($id_status) {
                return $query->where('id_status', $id_status);
            })
            ->when($data_minima && $data_minima != "", function ($query) use ($data_minima) {
                $data_minima = DateTime::createFromFormat('d/m/Y', $data_minima);
                $data_minima = $data_minima->format('Y-m-d');
                return $query->where('data_inicio', '>=', $data_minima);
            });

        if (request()->wantsJson()) {
            return response()->json(
                [
                    "message" => "success",
                    "data" => OrdemServicoResource::collection($ordens->get())
                ]
            );
        }

        $clientes = $this->clienteService->getAll()->get();
        $status = $this->statusService->getAll();
        $classificacao = $this->classificacaoService->getAll();
        $unidades = $this->unidadeService->getAll();
        $ordens = $ordens->paginate(10);

        return view('ordem_servico', compact('ordens', 'clientes', 'status', 'classificacao', 'unidades'));
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
    public function store(StoreOrdemServicoRequest $request) {
        $ordem = $this->osService->save($request->all());

        if (request()->wantsJson()) {
            return response()->json($ordem);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'OS cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $ordem = $this->osService->findByID($id);
        return $ordem;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdemServico $ordemServico) {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrdemServicoRequest $request, string $id) {
        $ordem = $this->osService->edit($request->all(), $id);

        if (request()->wantsJson()) {
            return response()->json($ordem);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'OS atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $ordem = $this->osService->delete($id);
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Ordem de serviço deletada com sucesso', 'data' => $ordem], 200);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Ordem de serviço deletada com sucesso!');
    }

    public function imprimir(string $id) {
        $ordemServico = $this->show($id);
        $ordemServico->equipamento->cliente->endereco = $ordemServico->equipamento->cliente->endereco->toArray();
        $pdf = Pdf::loadView('impressao', $ordemServico->toArray());
        return $pdf->stream();
        // return view('impressao', compact('ordemServico'));
    }

    public function imprimir_personalizado(Request $request) {
        $dados = $request->all();

        $ordemServico = $this->show($dados['os_id']);
        $ordemServico->checkboxes = $dados;

        if ($ordemServico->equipamento) {
            $ordemServico->equipamento = $ordemServico->equipamento->toArray();
        }

        $ordemServico->cliente->endereco = $ordemServico->cliente->endereco->toArray();
        $pdf = Pdf::loadView('impressao', $ordemServico->toArray());
        return $pdf->stream();
        // return view('impressao', compact('ordemServico'));
    }
}
