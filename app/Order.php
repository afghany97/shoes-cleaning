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
            $model->update(['barcode' => $model]);
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function shoes()
    {
        return $this->belongsTo(Shoes::class);
    }

    public function setBarcodeAttribute($value)
    {
        $this->attributes['barcode'] = $this->created_at->year . str_pad((string)$this->id,4,'0',STR_PAD_LEFT);
    }

    public static function createOrder($customer)
    {
        return self::create([

            'customer_id' => $customer->id,

            'image_path' => request()->file('image')->store('images','public'),

            'shoes_id' => request('shoes_id'),

            'price' => request('price'),

            'delivery_date' => request('delivery_date')

        ]);
    }

    public function scopeFilter($query,$filters)
    {
        return $filters->apply($query);
    }

    public function imagePath()
    {
        return "/storage/" . $this->image_path;
    }
}
