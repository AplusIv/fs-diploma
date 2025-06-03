<?php

namespace App\Http\Requests;

use App\Models\Hall;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaceRequest extends FormRequest
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
            'hall_id' => ['required', 'integer'],
            'row' => ['required', 'integer'],
            'place' => ['required', 'integer'],
            'type' => ['required', Rule::in(['vip', 'standart', 'disabled'])],
            'is_selected' => ['required', 'boolean'],
        ];
    }
}
