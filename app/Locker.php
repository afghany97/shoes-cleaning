<?php

namespace App;

class Locker extends Model
{

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function removeShoe()
    {
        $this->update(['order_id' => null]);

        return $this;
    }

    public function setFree()
    {
        $this->update(['status' => config('locker.status.free')]);

        return $this;
    }

    public function scopeFree($query)
    {
        return $query->where('status',config('locker.status.free'));
    }

    public function scopeProgress($query)
    {
        return $query->where('type',config('locker.type.progress'));
    }

    public function scopeCompleted($query)
    {
        return $query->where('type',config('locker.type.completed'));
    }

    public function keep(Order $order)
    {
        return $this->update(['status' => config('locker.status.busy'),'order_id' => $order->id]);
    }
}
