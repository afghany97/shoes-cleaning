<?php
/**
 * Created by PhpStorm.
 * User: afghany
 * Date: 18/08/18
 * Time: 08:22 م
 */

namespace App\Filters;

use App\Customer;
use App\Shoe;

class OrdersFilter extends Filters
{
    protected $filters = ['date','status','name','mobile','shoe'];

    public function apply($query)
    {
        parent::apply($query);

        if (!request()->filled('from'))

            return;

        return $this->date(request('from'), request('to'));
    }

    public function status()
    {
        return $this->query->where('status',request('status'));
    }

    public function name()
    {
        $customer = Customer::where('name',request('name'))->first();

        return $this->query->where('customer_id' ,$customer ? $customer->id : null);
    }

    public function mobile()
    {
        $customer = Customer::where('mobile',request('mobile'))->first();

        return $this->query->where('customer_id',$customer ? $customer->id : null);
    }

    public function shoe()
    {
        $shoe = Shoe::where('type' , request('shoe'))->first();

        return $this->query->where('shoes_id',$shoe ? $shoe->id : null);
    }
}