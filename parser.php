<?php
  $file = file_get_contents('https://agileui.com/demo/delight/demo/admin-template/index.html');
  $copy = fopen('index.html', 'a+');
  fwrite($copy, $file);
?>
