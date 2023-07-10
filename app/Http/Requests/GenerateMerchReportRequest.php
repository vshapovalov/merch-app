<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateMerchReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'year' => 'required|integer|min:2022|max:2050',
            'week' => 'required|integer|min:1|max:52',
        ];
    }
}
