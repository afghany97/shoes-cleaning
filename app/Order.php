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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoes()
    {
        return $this->hasOne(shoes::class);
    }

    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = $this->created_at->year . str_pad((string)$this->id,4,'0',STR_PAD_LEFT);
    }
}
