<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use InvalidArgumentException;

class IsValidEmailAddress implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(! is_string($value)) {
            $fail('The value must be a string!');
        }

        if(!preg_match_all('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $value))
        {
            $fail('The value must be a valid email address!');
        }
    }
}
