<?php

namespace App;

use Carbon\Carbon;

class Order extends Model
{
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->update(['barcode' => $model]);
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function locker()
    {
        return $this->hasOne(Locker::class);
    }

    public function setBarcodeAttribute()
    {
        $this->attributes['barcode'] = $this->created_at->year . $this->created_at->format('m') . str_pad((string)$this->id, 4, '0', STR_PAD_LEFT);
    }

    public static function createOrder($customer)
    {
        return self::create(array_merge([

            'customer_id' => $customer->id,

            'image_path' => request()->file('image') ? request()->file('image')->store('images', 'public') : null,

            'shoe_id' => request('shoes_id'),

            'price' => request('price'),

            'sensitive' => !!request('sensitive'),

            'note' => request('note'),

            'priority' => request('priority')

        ],request('delivery_date') ? ['delivery_date' => request('delivery_date')] : []));
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function imagePath()
    {
        return "/storage/" . $this->image_path;
    }

    public function removeLocker()
    {
        $this->update(['locker_id' => null]);

        return $this;
    }

    public function storeAt(Locker $locker)
    {
        return $this->update(['locker_id' => $locker->id]);
    }

    public function complete()
    {
        $this->update(['status' => config('order.status.completed')]);

        return $this;
    }

    public function delivered()
    {
        $this->update(['status' => config('order.status.delivered')]);

        return $this;
    }

    public function moveToCompletedLocker()
    {
        $completedLocker = Locker::free()->completed()->undeleted()->first();

        if ($completedLocker) {

            $completedLocker->keep($this);

            $this->storeAt($completedLocker);
        }
    }

    public function getPdfFileName()
    {
        return "documents/pdf/" . $this->barcode . "_" .  Carbon::now()->timestamp . ".pdf";
    }

    public function scopePriority($query)
    {
        return $query->orderBy('priority','desc');
    }
}
