<?php

namespace App\Http\Requests\DashboardChart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDashboardChartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:dashboard_charts,name,' . $this->id],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'boolean'],
        ];
    }
}
