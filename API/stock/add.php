<?php 

    include_once 'api.php';

    $api = new API();
    require '../../phpqrcode/qrlib.php';

    $product_code =  $_POST['new-product-code'];
    $name = $_POST['new-product-name'];
    $description = $_POST['new-product-description'];
    $category = $_POST['new-product-category'];

    const AMOUNT = 0;

    $dir = '../../qrtemp/';
    if( !file_exists($dir) ) {
      mkdir($dir);
    }
  
    $filename = $dir . 'junglalmacen'.$name . $product_code.'.png';
    $size = 5;
    $level = 'H';
    $frameSize = 1;
    $content = 'https://junglalmacen.com/view.php?id=' . $product_code;
  
    QRcode::png($content, $filename, $level, $size, $frameSize);

    if ( !isset($product_code, $name, $description, $category) ){
        $api->error(400, "Error al llamar a la API");
        die();
    }

    $qrPath = str_replace('../../', '', $filename);

    $item = array(
        'product_code' => (int) $product_code,
        'name' => $name,
        'description' => $description,
        'category' => (int) $category,
        'amount' =>  AMOUNT,
        'qr' => $qrPath
    );

    $api->add($item);
