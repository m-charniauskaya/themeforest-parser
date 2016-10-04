<?php
  $file = file_get_contents('https://agileui.com/demo/delight/demo/admin-template/index.html');
  $downloadDir = 'downloads';
  // added to test  
  if (!is_dir(__DIR__.'/'.$downloadDir)){
    mkdir (__DIR__.'/downloads');
  }
  file_put_contents(__DIR__.'/'.$downloadDir.'/index.html', $file);
  echo $file;
?>
