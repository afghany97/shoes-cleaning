<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected  $guarded =[];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
