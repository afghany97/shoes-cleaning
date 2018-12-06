<?php
/**
 * Created by PhpStorm.
 * User: afghany
 * Date: 25/09/18
 * Time: 05:31 م
 */

namespace App;


trait mediable
{
    public function media()
    {
        return $this->morphMany(Media::class,'mediable');
    }

    private function storeMedia(array $data)
    {
        return $this->media()->create($data);
    }

    public function image($path,$period)
    {
        return $this->storeMedia(['path' => $path, 'type' => 'image','period' => $period]);
    }

    public function video($path,$period)
    {
        return $this->storeMedia(['path' => $path, 'type' => 'video','period' => $period]);
    }

    public function hasImages($period)
    {
        return !! $this->media()->images()->$period()->count();
    }

    public function hasVideos()
    {
        return !! $this->media()->videos()->count();
    }

    public function beforeImage($path)
    {
        return $this->image($path,'before');
    }

    public function afterImage($path)
    {
        return $this->image($path,'after');
    }

    public function beforeVideo($path)
    {
        return $this->video($path,'before');
    }

    public function afterVideo($path)
    {
        return $this->video($path,'after');
    }

    public function hasBeforeImages()
    {
        return $this->hasImages('before');
    }

    public function hasAfterImages()
    {
        return $this->hasImages('after');
    }
}