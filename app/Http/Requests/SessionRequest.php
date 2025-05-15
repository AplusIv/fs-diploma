<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false; // true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $today = date('Y-m-d');
        return [
            // подумать над валидацией даты и времени
            // 'date'=> ['required', 'date_format:Y-m-d', "after_or_equal:{$today}"],
            'date'=> ['required', 'date_format:Y-m-d'],
            // 'date'=> ['required', 'date_format:d.m.Y'],
            'time'=> ['required', 'date_format:H:i'],
            'hall_id' => ['required', 'integer'],
            'movie_id' => ['required', 'integer'],
        ];
    }
}
