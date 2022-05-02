<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'image_url' => ['required', 'url'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['sometimes'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['sometimes', 'numeric', 'min:0'],
            'size' => ['required', 'in:PP,P,M,G,GG,XG'],
            'condition' => ['required', 'in:novo,seminovo,usado'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório.',
            'title.max' => 'O texto deve ter no máximo :max caracteres.',
            'in' => 'Selecione uma das opções disponíveis.',
            'numeric' => 'Deve ser um número.',
            'price.min' => 'Deve ser maior que :min.',
            'url' => 'Deve ser um endereço url válido.',
        ];
    }
}
