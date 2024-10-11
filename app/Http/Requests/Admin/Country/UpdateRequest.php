<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'iso_code' => 'required|string|max:50',
            'image' => 'required',
//            |image|mimes:jpg,jpeg,png,gif|max:2048',
            'working_hours' => 'required|string|max:255', // You can adjust this depending on the format
            'currency_id' => 'required|string', // Nullable and must be a valid URL if provided
            'weight_id' => 'required|string', // Nullable and must be a valid URL if provided
            'length_id' => 'required|string', // Nullable and must be a valid URL if provided
            'commission' => 'required|min:0', // Nullable and must be a valid URL if provided
            'status' => 'required|in:0,1', // Nullable and must be a valid URL if provided
        ];
    }


}
