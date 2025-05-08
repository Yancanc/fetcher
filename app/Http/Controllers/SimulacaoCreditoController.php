<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimulacaoCreditoRequest;
use App\Http\Resources\SimulacaoCreditoResource;
use App\Services\SimulacaoCreditoService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SimulacaoCreditoController extends Controller
{
    /**
     * @var SimulacaoCreditoService
     */
    protected SimulacaoCreditoService $simulacaoCreditoService;
    
    /**
     * Constructor
     * 
     * @param SimulacaoCreditoService $simulacaoCreditoService
     */
    public function __construct(SimulacaoCreditoService $simulacaoCreditoService)
    {
        $this->simulacaoCreditoService = $simulacaoCreditoService;
    }
    
    /**
     * Realiza a simulação de crédito
     * 
     * @OA\Post(
     *     path="/api/v1/simulacao-credito",
     *     operationId="simularCredito",
     *     tags={"Simulação de Crédito"},
     *     summary="Realiza uma simulação de crédito",
     *     description="Recebe os parâmetros para simulação e retorna as opções de crédito disponíveis",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"valor_emprestimo"},
     *             @OA\Property(property="valor_emprestimo", type="number", format="float", example=5000, description="Valor do empréstimo desejado"),
     *             @OA\Property(property="instituicoes", type="array", @OA\Items(type="string"), example={"banco1", "banco2"}, description="Lista de instituições para filtrar (opcional)"),
     *             @OA\Property(property="convenios", type="array", @OA\Items(type="string"), example={"conv1", "conv2"}, description="Lista de convênios para filtrar (opcional)"),
     *             @OA\Property(property="parcela", type="integer", example=12, description="Número de parcelas desejado (opcional)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Simulação realizada com sucesso",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SimulacaoCredito")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro na validação dos dados",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Os dados fornecidos são inválidos"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="valor_emprestimo", type="array", @OA\Items(type="string", example="O valor do empréstimo é obrigatório"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     *
     * @param SimulacaoCreditoRequest $request
     * @return AnonymousResourceCollection
     */
    public function simular(SimulacaoCreditoRequest $request): AnonymousResourceCollection
    {
        // Obter os dados validados da requisição
        $valorEmprestimo = (float) $request->input('valor_emprestimo');
        $instituicoes = $request->input('instituicoes');
        $convenios = $request->input('convenios');
        $parcela = $request->input('parcela');
        
        // Realizar a simulação
        $resultado = $this->simulacaoCreditoService->simular(
            $valorEmprestimo,
            $instituicoes,
            $convenios,
            $parcela
        );
        
        // Retornar o resultado formatado
        return SimulacaoCreditoResource::collection($resultado);
    }
} 