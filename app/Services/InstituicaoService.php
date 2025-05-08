<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class InstituicaoService
{
    /**
     * Retorna todas as instituições formatadas
     *
     * @return array
     */
    public function getInstituicoes(): array
    {
        $instituicoes = $this->loadJsonData();
        
        // Formata o resultado usando a chave como id e o valor como valor final
        $resultado = [];
        foreach ($instituicoes as $instituicao) {
            $resultado[] = [
                'id' => $instituicao['chave'],
                'valor' => $instituicao['valor']
            ];
        }
        
        return $resultado;
    }
    
    /**
     * Retorna uma instituição específica pelo ID (chave)
     *
     * @param string $id
     * @return array|null
     */
    public function getInstituicao(string $id): ?array
    {
        $instituicoes = $this->loadJsonData();
        
        // Busca a instituição pelo ID (chave)
        foreach ($instituicoes as $item) {
            if ($item['chave'] === $id) {
                return [
                    'id' => $item['chave'],
                    'valor' => $item['valor']
                ];
            }
        }
        
        return null;
    }
    
    /**
     * Carrega os dados do arquivo JSON
     *
     * @return array
     */
    private function loadJsonData(): array
    {
        // Obtém o conteúdo do arquivo JSON
        $jsonContent = Storage::disk('public')->get('instituicoes.json');
        
        // Decodifica o JSON
        return json_decode($jsonContent, true);
    }
} 