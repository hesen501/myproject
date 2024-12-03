<?php

namespace App\Http\Requests\Admin\Tariff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'description' => 'required|string|max:1000',
            'min_weight' => 'required|integer|min:0',
            'max_weight' => 'required|integer|min:0|gt:min_weight', // Ensure max_weight is greater than min_weight
            'fee' => 'required|numeric|min:0',
            'type' => [
                'required',
                Rule::in(['regular', 'liquid']),
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
                function ($attribute, $value, $fail) {
                    // Count existing tariffs for the same country_id and type
                    $count = DB::table('tariffs')
                        ->where('country_id', $value)
                        ->where('type', $this->type) // Use the type from the request
                        ->count();

                    if ($count >= 6) {
                        $fail('A maximum of 6 tariffs are allowed for the selected country and type.');
                    }
                },
            ],
        ];
    }


}
