<?php

namespace App;

class Validator
{
    public function validateRequiredString($value): bool
    {
        return !empty($value) && is_string($value);
    }
}
