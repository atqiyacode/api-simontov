<?php

namespace App\Http\Requests\DashboardChart;

use Illuminate\Foundation\Http\FormRequest;

class CreateDashboardChartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:dashboard_charts,name'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ];
    }
}
