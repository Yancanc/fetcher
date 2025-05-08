<?php

namespace App\OpenApi;

/**
 * @OA\Schema(
 *     schema="Convenio",
 *     title="Convênio",
 *     description="Modelo de convênio para simulação de crédito",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="Identificador único do convênio",
 *         example="INSS"
 *     ),
 *     @OA\Property(
 *         property="valor",
 *         type="string",
 *         description="Nome do convênio",
 *         example="Instituto Nacional do Seguro Social"
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="Instituicao",
 *     title="Instituição",
 *     description="Modelo de instituição financeira para simulação de crédito",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="Identificador único da instituição",
 *         example="BC001"
 *     ),
 *     @OA\Property(
 *         property="valor",
 *         type="string",
 *         description="Nome da instituição financeira",
 *         example="Banco X"
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="SimulacaoCredito",
 *     title="Simulação de Crédito",
 *     description="Resultado de uma simulação de crédito",
 *     @OA\Property(
 *         property="instituicao",
 *         type="string",
 *         description="Nome da instituição financeira",
 *         example="Banco X"
 *     ),
 *     @OA\Property(
 *         property="convenio",
 *         type="string",
 *         description="Nome do convênio",
 *         example="INSS"
 *     ),
 *     @OA\Property(
 *         property="parcelas",
 *         type="integer",
 *         description="Número de parcelas da simulação",
 *         example=12
 *     ),
 *     @OA\Property(
 *         property="taxaJuros",
 *         type="number",
 *         format="float",
 *         description="Taxa de juros mensal aplicada",
 *         example=1.99
 *     ),
 *     @OA\Property(
 *         property="valorParcela",
 *         type="number",
 *         format="float",
 *         description="Valor de cada parcela",
 *         example=458.33
 *     ),
 *     @OA\Property(
 *         property="valorTotal",
 *         type="number",
 *         format="float",
 *         description="Valor total a ser pago",
 *         example=5500.00
 *     ),
 *     @OA\Property(
 *         property="valorEmprestimo",
 *         type="number",
 *         format="float",
 *         description="Valor do empréstimo solicitado",
 *         example=5000.00
 *     )
 * )
 */
class Schemas
{
    // Esta classe serve apenas para documentação OpenAPI e não contém lógica de aplicação
} 