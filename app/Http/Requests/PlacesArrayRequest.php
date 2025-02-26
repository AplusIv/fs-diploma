<?php

namespace App\Http\Requests;

use App\Models\Hall;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlacesArrayRequest extends FormRequest
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
        // return [
        //     'hall_id' => ['required', 'integer'],
        //     // 'session_id' => ['required', 'integer'],

        //     // 'ticket_id' => ['nullable', 'integer'],

        //     'row' => ['required', 'integer'],
        //     'place' => ['required', 'integer'],
        //     // 'type' => ['required', 'string'],
        //     // 'type' => ['required', Rule::in(['vip', 'normal', 'not allowed'])],
        //     'type' => ['required', Rule::in(['vip', 'standart', 'disabled'])],

            
        //     // 'is_free' => ['required'], // boolean не проходит валидацию
        //     // 'is_free' => ['nullable', 'boolean'], // boolean не проходит валидацию
        //     'is_selected' => ['required', 'boolean'],
            
        //     // 'price' => ['nullable', 'decimal:2'],
        // ];

        return [
            '*.id' => ['required', 'integer'],
            '*.hall_id' => ['required', 'integer'],
            // 'session_id' => ['required', 'integer'],

            // 'ticket_id' => ['nullable', 'integer'],

            '*.row' => ['required', 'integer'],
            '*.place' => ['required', 'integer'],
            // 'type' => ['required', 'string'],
            // 'type' => ['required', Rule::in(['vip', 'normal', 'not allowed'])],
            '*.type' => ['required', Rule::in(['vip', 'standart', 'disabled'])],

            
            // 'is_free' => ['required'], // boolean не проходит валидацию
            // 'is_free' => ['nullable', 'boolean'], // boolean не проходит валидацию
            '*.is_selected' => ['required', 'boolean'],
            
            // 'price' => ['nullable', 'decimal:2'],
        ];
    }
}
