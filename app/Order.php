<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $guarded =[];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model){
            $model->update(['token' => $model]);
        });
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function shoes()
    {
        return $this->belongsTo(shoes::class);
    }

    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = $this->created_at->year . str_pad((string)$this->id,4,'0',STR_PAD_LEFT);
    }

    public static function addOrder($customer)
    {
        return self::create([

            'customer_id' => $customer->id,

            'image_path' => request()->file('image')->store('images','public'),

            'shoes_id' => request('shoes_id')

        ]);
    }

    public function path()
    {
        return "/orders/" . $this->id;
    }
}
