<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConvenioResource;
use App\Services\ConvenioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConvenioController extends Controller
{
    /**
     * @var ConvenioService
     */
    protected ConvenioService $convenioService;
    
    /**
     * Constructor
     * 
     * @param ConvenioService $convenioService
     */
    public function __construct(ConvenioService $convenioService)
    {
        $this->convenioService = $convenioService;
    }
    
    /**
     * Retorna a lista de convênios formatada
     * 
     * @OA\Get(
     *     path="/api/v1/convenios",
     *     operationId="getConvenios",
     *     tags={"Convênios"},
     *     summary="Lista todos os convênios disponíveis",
     *     description="Retorna a lista completa de convênios que podem ser utilizados para simulação de crédito",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de convênios retornada com sucesso",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Convenio")
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
        $convenios = $this->convenioService->getConvenios();
        return ConvenioResource::collection($convenios);
    }
    
    /**
     * Retorna um convênio específico pelo ID (chave)
     * 
     * @OA\Get(
     *     path="/api/v1/convenios/{id}",
     *     operationId="getConvenioById",
     *     tags={"Convênios"},
     *     summary="Busca um convênio pelo ID",
     *     description="Retorna os dados de um convênio específico identificado pelo ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID do convênio",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Convênio encontrado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Convenio")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Convênio não encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Convênio não encontrado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     *
     * @param string $id
     * @return ConvenioResource|JsonResponse
     */
    public function show(string $id): ConvenioResource|JsonResponse
    {
        $convenio = $this->convenioService->getConvenio($id);
        
        if (!$convenio) {
            return response()->json(['message' => 'Convênio não encontrado'], 404);
        }
        
        return new ConvenioResource($convenio);
    }
} 