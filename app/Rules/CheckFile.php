<?php

namespace App\Rules;

use App\Helpers\ClientHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckFile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $file = ClientHelper::checkFileByID($value);

        if (!$file) {
            $fail('The :attribute not found.');
        }
    }
}
