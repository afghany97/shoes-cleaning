<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

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
        if(! request()->wantsJson())

            return static::where('mobile' , request('mobile'))->firstOr(function(){

                return self::create(static::Data());
            });

    }
}