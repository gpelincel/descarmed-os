<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

class OrdemServicoAPIController extends Controller {

    private $osService;

    public function __construct(OrdemServicoService $osService) {
        $this->osService = $osService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $search = request('search');
        $field = request('field', 'titulo'); // Valor padrão: 'titulo'
        $id_status = request('id_status');
        $id_classificacao = request('id_classificacao');
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
            ->when($id_classificacao && $id_classificacao != 0, function ($query) use ($id_classificacao) {
                return $query->where('id_classificacao', $id_classificacao);
            })
            ->when($data_minima && $data_minima != "", function ($query) use ($data_minima) {
                $data_minima = DateTime::createFromFormat('d/m/Y', $data_minima);
                $data_minima = $data_minima->format('Y-m-d');
                return $query->where('data_inicio', '>=', $data_minima);
            })->paginate(10);

        $ordens->appends(request()->query());
        $ordens->data = OrdemServicoResource::collection($ordens);

        return response()->json($ordens);
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

        return response()->json(['status' => 'success', 'message' => 'Ordem de serviço cadastrada com sucesso', 'data' => $ordem], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $ordem = $this->osService->findByID($id);
        return response()->json(new OrdemServicoResource($ordem));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrdemServicoRequest $request, string $id) {
        $ordem = $this->osService->edit($request->all(), $id);

        return response()->json(['status'=>'success','message' => 'Ordem de serviço atualizada com sucesso', 'data' => $ordem], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $ordem = $this->osService->delete($id);
        return response()->json(['status'=>'success', 'message' => 'Ordem de serviço deletada com sucesso', 'data' => $ordem], 200);
    }

    public function imprimir_personalizado(Request $request, string $id) {
        $dados = $request->all();

        $ordemServico = $this->osService->findByID($id);
        $ordemServico->checkboxes = $dados;

        if ($ordemServico->equipamento) {
            $ordemServico->equipamento = $ordemServico->equipamento->toArray();
        }

        $ordemServico->cliente->endereco = $ordemServico->cliente->endereco->toArray();

        return response()->json([$ordemServico->toArray()], 200);

        $pdf = Pdf::loadView('impressao', $ordemServico->toArray());
        // return var_dump($pdf->stream());
        // return $pdf->stream("ordem_servico_{$id}.pdf");
        // return $pdf->download("ordem-servico-{$id}.pdf");
    }
}
