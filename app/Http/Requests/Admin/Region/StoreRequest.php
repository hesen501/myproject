<?php

namespace App\Http\Requests\Admin\Region;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'slug' => 'required|unique:cities|max:50',
            'city_id' => 'required|exists:cities,id',
            'distance' => 'required|numeric|min:0',
            'zip_code' => 'required',
            'delivery_cost' => 'required|numeric|min:0'
        ];
    }
}
