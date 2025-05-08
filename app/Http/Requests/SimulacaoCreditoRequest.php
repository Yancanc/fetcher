<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimulacaoCreditoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'valor_emprestimo' => 'required|numeric|min:0.01',
            'instituicoes' => 'sometimes|array',
            'instituicoes.*' => 'string',
            'convenios' => 'sometimes|array',
            'convenios.*' => 'string',
            'parcela' => 'sometimes|integer|min:1'
        ];
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'valor_emprestimo.required' => 'O valor do empréstimo é obrigatório',
            'valor_emprestimo.numeric' => 'O valor do empréstimo deve ser um número',
            'valor_emprestimo.min' => 'O valor do empréstimo deve ser maior que zero',
            'instituicoes.array' => 'O campo instituições deve ser um array',
            'convenios.array' => 'O campo convênios deve ser um array',
            'parcela.integer' => 'O número de parcelas deve ser um número inteiro',
            'parcela.min' => 'O número de parcelas deve ser maior que zero'
        ];
    }
} 