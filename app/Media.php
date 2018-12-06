<?php

namespace App;

class Media extends Model
{
    public function mediable()
    {
        return $this->morphTo();
    }

    public function scopeImages($query)
    {
        return $query->whereType('image');
    }

    public function scopeVideos($query)
    {
        return $query->whereType('video');
    }

    public function scopeBefore($query)
    {
        return $query->wherePeriod('before');
    }

    public function scopeAfter($query)
    {
        return $query->wherePeriod('after');
    }

    public function fullPath()
    {
        return "/storage/" . $this->path;
    }

    public function getFileExtension()
    {
        $explode = explode(".",$this->path);

        return end($explode);
    }
}
