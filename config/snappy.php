<?php

$pdfBinaryPath = strpos(php_uname(),"Linux") !== false ? base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64') : '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"';

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => $pdfBinaryPath,
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
