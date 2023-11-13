<?php

namespace App\Http\Requests\DashboardChart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDashboardChartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'status' => ['sometimes', 'boolean'],
        ];
    }
}
