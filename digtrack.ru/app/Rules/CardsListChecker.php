<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardsListChecker implements Rule{

    private $min_card_id;
    private $max_card_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->min_card_id = 1;
        $this->max_card_id = 36;
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
        // значение должно быть массивом
        if(is_array($value)){
            if(count($value) == 0){ return true; }
            foreach ($value as $item) {
                // каждый элемент массива должен быть целочисленным числом
                if(!is_integer($item)){
                    return false;
                }else{
                    // которое принадлежит промежутку от минимального до максимального значения
                    if($item >= $this->min_card_id && $item <= $this->max_card_id){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
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
