<?php

namespace App\Rules;

use App\Locker;
use Illuminate\Contracts\Validation\Rule;

class CheckIfLockersRangeIsValid implements Rule
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
    public function passes($attribute, $value)
    {
        $lockersNumbers = Locker::pluck('number')->toArray();

        $numbersRange = range(request('start'),request('end'));

        foreach ($numbersRange as $number){

            if(in_array($number,$lockersNumbers))

                return false;
        }
        return true;
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
