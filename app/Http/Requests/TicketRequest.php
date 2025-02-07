<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
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
            '*.place_id' => ['required', 'integer'], // *. валидация элемента массива
            '*.session_id' => ['required', 'integer'], // валидация элемента массива
            // order_id
            '*.status' => ['required', Rule::in(['not_selected', 'booked', 'paid'])], // валидация элемента массива
        ];
    }
}
