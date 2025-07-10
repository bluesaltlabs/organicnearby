<?php

namespace App\Http\Requests\Farm;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocationRules;

class FarmUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge([
            'slug' => 'required|string|unique:farms,slug,' . $this->route('farm')?->id,
            'name' => 'required|string',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'is_approved' => 'boolean',
            'logo_url' => 'nullable|string',
            'website_url' => 'nullable|string',
        ], LocationRules::rules());
    }
}
