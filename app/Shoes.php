<?php

namespace App;

class Shoes extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_shoes');
    }

    public static function addShoes()
    {
        self::create([

            'type' => request('shoes_type')

        ]);
    }
}
