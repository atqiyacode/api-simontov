<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'username' => 'required|alpha_num|max:50|unique:users,username,' . $this->id,
            'email' => 'required|email|max:150|unique:users,email,' . $this->id,
            'password' => 'nullable|string|max:150|confirmed',
            'roles' => 'required|array',
            'permissions' => 'nullable|array',
            'locations' => 'nullable|array',
            'dashboardCharts' => 'nullable|array',
        ];
    }
}
