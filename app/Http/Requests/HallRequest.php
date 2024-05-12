<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false; // true
        return true; // true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'rows' => ['required', 'integer'],
            'places' => ['required', 'integer'],
            // 'normal_price' => ['nullable', 'decimal:2'],
            // 'vip_price' => ['nullable', 'decimal:2'],
            'normal_price' => ['nullable', 'integer'],
            'vip_price' => ['nullable', 'integer'],
        ];
    }
}
