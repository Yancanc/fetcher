<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimulacaoCreditoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'instituicao' => $this['instituicao'],
            'convenio' => $this['convenio'],
            'parcelas' => $this['parcelas'],
            'taxaJuros' => $this['taxaJuros'],
            'valorParcela' => $this['valorParcela'],
            'valorTotal' => $this['valorTotal'],
            'valorEmprestimo' => $this['valorEmprestimo']
        ];
    }
} 