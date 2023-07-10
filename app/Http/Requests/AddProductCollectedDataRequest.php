<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductCollectedDataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|string|exists:products,id',
            'price' => 'required|decimal:0,2|min:0',
            'qty' => 'required|decimal:0,2|min:0',
        ];
    }
}
