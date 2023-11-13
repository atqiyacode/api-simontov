<?php

namespace App\Http\Requests\DashboardChart;

use Illuminate\Foundation\Http\FormRequest;

class CreateDashboardChartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ];
    }
}
