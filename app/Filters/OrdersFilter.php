<?php
/**
 * Created by PhpStorm.
 * User: afghany
 * Date: 18/08/18
 * Time: 08:22 م
 */

namespace App\Filters;


class OrdersFilter extends Filters
{
    protected $filters = ['date'];

    public function apply($query)
    {
        parent::apply($query);

        if (!request()->filled('from'))

            return;

        return $this->date(request('from'), request('to'));

    }
}