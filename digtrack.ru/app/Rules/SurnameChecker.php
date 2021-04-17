<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SurnameChecker implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    // /^[a-zA-Z\ \-]{2,20}|[а-яА-Я\ \-]{2,20}$/
    // https://regex101.com/r/bSi1kR/2
    public function passes($attribute, $value)
    {
        //
        return preg_match('/^[a-zA-Z\ \-]{2,20}$|^[а-яА-Я\ \-]{2,20}$/mu', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '1The validation error message.';
    }
}
