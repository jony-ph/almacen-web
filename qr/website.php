<?php

  require '../phpqrcode/qrlib.php';

  $dir = '../qrtemp/';

  if( !file_exists($dir) ) {
    mkdir($dir);
  }

  $filename = $dir . 'junglalmacen.png';
  $size = 10;
  $level = 'H';
  $frameSize = 1;
  $content = 'https://junglalmacen.com';

  QRcode::png($content, $filename, $level, $size, $frameSize);

  echo '<img src="'.$filename.'" />';