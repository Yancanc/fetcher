<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SimulacaoCreditoService
{
    /**
     * Realiza a simulação de crédito
     *
     * @param float $valorEmprestimo
     * @param array|null $instituicoes
     * @param array|null $convenios
     * @param int|null $parcela
     * @return array
     */
    public function simular(float $valorEmprestimo, ?array $instituicoes = null, ?array $convenios = null, ?int $parcela = null): array
    {
        // Carrega os dados de taxas
        $taxas = $this->loadJsonData();
        
        // Filtra as taxas conforme os parâmetros informados
        $taxasFiltradas = $this->filtrarTaxas($taxas, $instituicoes, $convenios, $parcela);
        
        // Formata o resultado e calcula o valor das parcelas
        $resultado = $this->formatarResultado($taxasFiltradas, $valorEmprestimo);
        
        return $resultado;
    }
    
    /**
     * Filtra as taxas conforme os parâmetros informados
     *
     * @param array $taxas
     * @param array|null $instituicoes
     * @param array|null $convenios
     * @param int|null $parcela
     * @return array
     */
    private function filtrarTaxas(array $taxas, ?array $instituicoes = null, ?array $convenios = null, ?int $parcela = null): array
    {
        return array_filter($taxas, function ($taxa) use ($instituicoes, $convenios, $parcela) {
            // Filtro por instituições
            if ($instituicoes !== null && !in_array($taxa['instituicao'], $instituicoes)) {
                return false;
            }
            
            // Filtro por convênios
            if ($convenios !== null && !in_array($taxa['convenio'], $convenios)) {
                return false;
            }
            
            // Filtro por parcela
            if ($parcela !== null && $taxa['parcelas'] != $parcela) {
                return false;
            }
            
            return true;
        });
    }
    
    /**
     * Formata o resultado e calcula o valor das parcelas
     *
     * @param array $taxas
     * @param float $valorEmprestimo
     * @return array
     */
    private function formatarResultado(array $taxas, float $valorEmprestimo): array
    {
        $resultado = [];
        
        foreach ($taxas as $taxa) {
            // Calcula o valor da parcela usando a fórmula: Valor solicitado * coeficiente
            $valorParcela = $valorEmprestimo * $taxa['coeficiente'];
            
            $resultado[] = [
                'instituicao' => $taxa['instituicao'],
                'convenio' => $taxa['convenio'],
                'parcelas' => $taxa['parcelas'],
                'taxaJuros' => $taxa['taxaJuros'],
                'valorParcela' => round($valorParcela, 2),
                'valorTotal' => round($valorParcela * $taxa['parcelas'], 2),
                'valorEmprestimo' => $valorEmprestimo
            ];
        }
        
        return $resultado;
    }
    
    /**
     * Carrega os dados do arquivo JSON
     *
     * @return array
     */
    private function loadJsonData(): array
    {
        // Obtém o conteúdo do arquivo JSON
        $jsonContent = Storage::disk('public')->get('taxas_instituicoes.json');
        
        // Decodifica o JSON
        return json_decode($jsonContent, true);
    }
} 