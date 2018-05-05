<?php

namespace App\Rules;


class mobile {

    public function passes($attribute,$value)
    {
        if(strlen($value) != 11)

            return false;

        return true;
    }
}

