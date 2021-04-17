<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LangChecker implements Rule
{
    private $lang;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //доступные языки
        $this->lang = array(
            'ru',
            'en'
        );
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
        return in_array($value, $this->lang);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
