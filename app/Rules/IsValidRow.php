<?php

namespace App\Rules;

use App\Models\Hall;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsValidRow implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // return $value <= Hall::find($id);
    }
}
