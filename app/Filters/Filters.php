<?php
/**
 * Created by PhpStorm.
 * User: afghany
 * Date: 18/08/18
 * Time: 08:20 م
 */

namespace App\Filters;

use DateTime;

abstract class Filters
{
    protected $filters = [], $query;

    public function apply($query)
    {
        $this->query = $query;

        foreach ($this->filters as $filter) {

            if (method_exists($this, $filter) && request()->filled($filter)) {

                $this->$filter();
            }
        }

        return $this->query;
    }

    protected function date($from, $to = null)
    {
        $to = request()->filled('to') ? request('to') : (new DateTime(date('Y-m-d')))->modify('+1 day');;

        $from = new DateTime(request('from'));

        return $this->query->where([['created_at', '>=', $from], ['created_at', '<=', $to]]);
    }

}