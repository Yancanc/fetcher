<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ConvenioService
{
    /**
     * Retorna todos os convênios formatados
     *
     * @return array
     */
    public function getConvenios(): array
    {
        $convenios = $this->loadJsonData();
        
        // Formata o resultado usando a chave como id e o valor como valor final
        $resultado = [];
        foreach ($convenios as $convenio) {
            $resultado[] = [
                'id' => $convenio['chave'],
                'valor' => $convenio['valor']
            ];
        }
        
        return $resultado;
    }
    
    /**
     * Retorna um convênio específico pelo ID (chave)
     *
     * @param string $id
     * @return array|null
     */
    public function getConvenio(string $id): ?array
    {
        $convenios = $this->loadJsonData();
        
        // Busca o convênio pelo ID (chave)
        foreach ($convenios as $item) {
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
        $jsonContent = Storage::disk('public')->get('convenios.json');
        
        // Decodifica o JSON
        return json_decode($jsonContent, true);
    }
} 