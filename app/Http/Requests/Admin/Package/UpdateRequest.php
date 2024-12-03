<?php

namespace App\Http\Requests\Admin\Package;

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
            'tracking_code' => 'required|string|max:255', // Required tracking code with a max length of 255
            'weight' => 'required|numeric|min:0', // Required positive numeric weight
            'invoice' => 'required|numeric|min:0', // Required positive numeric invoice amount
            'currency_id' => 'required|string|max:3', // Required currency code (assuming 3-letter ISO code)
            'quantity' => 'required|integer|min:1', // Required quantity, at least 1
            'description' => 'nullable|string|max:1000', // Optional description with a max length of 1000
            'user_id' => 'required|exists:users,id', // Required user_id that exists in the users table
            'store' => 'required|string|max:255', // Required store name with a max length of 255
            'is_liquid' => 'required|boolean', // Required boolean for liquid status
            'has_battery' => 'required|boolean', // Required boolean for battery status
            'print' => 'required|integer|in:0,1', // Required print indicator (0 or 1)
            'status' => 'required|integer|in:0,1', // Required status indicator (0 or 1)
            'type' => 'required|in:home,abroad', // Required type must be either 'home' or 'abroad'
            'parcel_id' => 'nullable|exists:parcels,id', // Optional parcel_id that exists in the parcels table
            'warehouse_id' => 'required|exists:warehouses,id', // Required warehouse_id that exists in the warehouses table
        ];
    }


}
