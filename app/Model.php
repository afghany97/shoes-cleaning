<?php

namespace App;

use Illuminate\Database\Eloquent\Model as laravelmodel;

class Model extends laravelmodel
{
    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean'
    ];

    public function softDelete()
    {
        return $this->update(['deleted' => true]);
    }

    public function scopeUndeleted($query)
    {
        return $query->whereDeleted(false);
    }
}
