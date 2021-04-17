<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KeyChecker implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    // 
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
    public function passes($attribute, $value)
    {
        //
        return preg_match('/^([A-Z0-9]{5})\-([A-Z0-9]{5})\-([A-Z0-9]{5})\-([A-Z0-9]{5})$/', $value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid key format.';
    }
}
