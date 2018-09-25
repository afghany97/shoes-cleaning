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

    public function image($path)
    {
        return $this->storeMedia(['path' => $path, 'type' => 'image']);
    }

    public function video($path)
    {
        return $this->storeMedia(['path' => $path, 'type' => 'video']);
    }

    public function hasImages()
    {
        return !! $this->media()->images()->count();
    }

    public function hasVideos()
    {
        return !! $this->media()->videos()->count();
    }

}