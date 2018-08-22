<?php

namespace App;

class Shoes extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function addShoes()
    {
        self::create([

            'type' => request('shoes_type')

        ]);
    }
}
