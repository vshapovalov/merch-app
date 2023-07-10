<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCollectedDataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'market_id' => 'required|string|exists:markets,id',
            'description' => "nullable|string|max:100",

            'collected_at' => "required|date_format:Y-m-d H:i:s",
            'products' => 'required|array',
            'products.*.id' => 'required|string|exists:products,id',
            'products.*.price' => 'required|decimal:0,2|min:0',
            'products.*.qty' => 'required|decimal:0,2|min:0',
        ];
    }
}
