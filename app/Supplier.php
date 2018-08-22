<?php

namespace App;

class Supplier extends Model
{
    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean'
    ];
}
