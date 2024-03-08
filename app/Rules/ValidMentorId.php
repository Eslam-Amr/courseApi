<?php

namespace App\Rules;

use App\Models\TechnicalEmployee;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidMentorId implements  Rule
{
    public function passes($attribute, $value)
    {
        // Check if the technical employee with the provided ID exists and has a role of 'instructor'
        return TechnicalEmployee::where('id', $value)->where('role', 'mentor')->exists();
    }

    public function message()
    {
        return 'The selected instructor is invalid.';
    }
}

