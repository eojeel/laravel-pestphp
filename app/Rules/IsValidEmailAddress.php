<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use InvalidArgumentException;

class IsValidEmailAddress implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value) : bool
    {
        if(! is_string($value)) {
            throw new InvalidArgumentException('The value must be a string!');
        }

        return preg_match_all('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $value) > 0;
    }
}
