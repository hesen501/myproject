<?php

namespace App\Http\Requests\Admin\Country;

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
            'title' => 'required|string|max:255',
            'iso_code' => 'required|string|max:50',
            'image' => 'required',
//            |image|mimes:jpg,jpeg,png,gif|max:2048',
            'working_hours' => 'required|string|max:255',
            'currency_id' => 'required|string',
            'weight_id' => 'required|string',
            'length_id' => 'required|string',
            'commission' => 'required|min:0',
            'status' => 'required|in:0,1',
        ];
    }


}
