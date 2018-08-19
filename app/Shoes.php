<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoes extends Model
{
    protected $guarded = [];

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
