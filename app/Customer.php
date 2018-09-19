<?php

namespace App;

class Customer extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public static function Data()
    {
        return [

            'name' => request('name'),

            'mobile' => request('mobile'),

            'address' => request('address')
        ];
    }

    public static function fetchOrCreate()
    {
        return static::where('mobile' , request('mobile'))->firstOr(function(){

            return self::create(static::Data());
        });

    }
}
