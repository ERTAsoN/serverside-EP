<?php

namespace Validators;

use MyVal\AbstractValidator;

class EmailValidator extends AbstractValidator
{
    protected string $message = 'Email should be the correct format.';

    public function rule(): bool
    {
        $emailPattern = '/^[\w.%+-]+@[\w.-]+\.[A-z]{2,5}$/';
        return preg_match($emailPattern, $this->value);
    }
}