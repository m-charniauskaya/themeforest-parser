<?php
  $file = file_get_contents('https://agileui.com/demo/delight/demo/admin-template/index.html');
  $downloadDir = 'downloads';
  if (file_exists(__DIR__.'/'.$downloadDir) != true){
    mkdir (__DIR__.'/downloads');
  }
  $copy = fopen(__DIR__.'/'.$downloadDir.'/index.html', 'a+');
  fwrite($copy, $file);
  echo $copy;
?>
