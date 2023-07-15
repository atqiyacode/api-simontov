<?php

namespace App\Http\Requests\v1\MobileVersion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMobileVersionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(['privateAccess']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'numeric', Rule::unique('mobile_versions')->where(function ($query) {
                return $query->where('mobile_device_type_id', $this->mobileVersion->mobile_device_type_id)
                    ->where('code', '!=', $this->mobileVersion->code);
            })],
            'name' => ['required', Rule::unique('mobile_versions')->where(function ($query) {
                return $query->where('mobile_device_type_id', $this->mobileVersion->mobile_device_type_id)
                    ->where('name', '!=', $this->mobileVersion->name);
            })],
            'note' => 'required|string|max:150',
            'app_file' => 'sometimes|file',
            'release_url' => 'nullable|url',
            'device' => 'required|exists:mobile_device_types,id',
            'build' => 'required|exists:mobile_build_types,id',
            'status' => 'required|exists:mobile_statuses,id',
        ];
    }
}
