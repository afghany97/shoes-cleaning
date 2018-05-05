<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
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

            'address' => 'ay habd'
        ];
    }

    public static function fetch()
    {
        if(! request()->wantsJson())

            return customer::where('mobile', request('mobile'))->firstOrCreate(static::Data());

    }
}
