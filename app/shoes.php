<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shoes extends Model
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
