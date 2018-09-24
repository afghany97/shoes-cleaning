<?php
/**
 * Created by PhpStorm.
 * User: afghany
 * Date: 24/09/18
 * Time: 07:54 م
 */

namespace App\Services\Export;


use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

class ExcelGenerator
{
    private $data;

    private $filename;

    public function __construct()
    {
        $this->filename = "documents/excel/" . Carbon::today()->format('Y-m-d') . "_" .Carbon::now()->timestamp . ".xlsx";
    }


    public function generate()
    {
        return (new FastExcel($this->data))->export($this->filename);
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

}