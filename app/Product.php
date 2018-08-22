<?php

namespace App;

class Product extends Model
{
    protected $with = ['supplier'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model){
            $model->update(['barcode' => $model]);
        });

    }

    public function setBarcodeAttribute()
    {
        $this->attributes['barcode'] = 'barcode';
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function imagePath()
    {
        return "/storage/" . $this->image_path;
    }
}
