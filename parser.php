<?php
  $file = file_get_contents('https://agileui.com/demo/delight/demo/admin-template/index.html');
  if (file_exists(__DIR__.'/downloads') != true){
    $downloads = mkdir (__DIR__.'/downloads');
  }
  $dh = opendir ($downloads);
  $copy = fopen('index.html', 'a+');
  fwrite($copy, $file);
  closedir($dh);
  var_dump($downloads);
?>
