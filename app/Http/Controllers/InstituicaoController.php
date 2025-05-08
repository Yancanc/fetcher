<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstituicaoResource;
use App\Services\InstituicaoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InstituicaoController extends Controller
{
    /**
     * @var InstituicaoService
     */
    protected InstituicaoService $instituicaoService;
    
    /**
     * Constructor
     * 
     * @param InstituicaoService $instituicaoService
     */
    public function __construct(InstituicaoService $instituicaoService)
    {
        $this->instituicaoService = $instituicaoService;
    }
    
    /**
     * Retorna a lista de instituições formatada
     * 
     * @OA\Get(
     *     path="/api/v1/instituicoes",
     *     operationId="getInstituicoes",
     *     tags={"Instituições"},
     *     summary="Lista todas as instituições financeiras disponíveis",
     *     description="Retorna a lista completa de instituições financeiras que podem ser utilizadas para simulação de crédito",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de instituições retornada com sucesso",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Instituicao")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $instituicoes = $this->instituicaoService->getInstituicoes();
        return InstituicaoResource::collection($instituicoes);
    }
    
    /**
     * Retorna uma instituição específica pelo ID (chave)
     * 
     * @OA\Get(
     *     path="/api/v1/instituicoes/{id}",
     *     operationId="getInstituicaoById",
     *     tags={"Instituições"},
     *     summary="Busca uma instituição financeira pelo ID",
     *     description="Retorna os dados de uma instituição financeira específica identificada pelo ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID da instituição",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Instituição encontrada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Instituicao")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Instituição não encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Instituição não encontrada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     *
     * @param string $id
     * @return InstituicaoResource|JsonResponse
     */
    public function show(string $id): InstituicaoResource|JsonResponse
    {
        $instituicao = $this->instituicaoService->getInstituicao($id);
        
        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }
        
        return new InstituicaoResource($instituicao);
    }
} 