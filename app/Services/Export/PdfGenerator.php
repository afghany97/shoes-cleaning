<?php
/**
 * Created by PhpStorm.
 * User: afghany
 * Date: 24/09/18
 * Time: 03:43 م
 */

namespace App\Services\Export;


use Illuminate\Support\Facades\App;

class PdfGenerator
{
    private $data;

    private $filename;

    public function generate()
    {
        $pdf = App::make('snappy.pdf');

        $pdf->generateFromHtml($this->data,$this->filename);

        return file_exists(str_replace("\\","/",public_path() . "\\" . $this->filename));

    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }


}