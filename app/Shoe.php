<?php

namespace App;

class Shoe extends Model
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
