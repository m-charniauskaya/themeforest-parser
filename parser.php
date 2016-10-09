<?php
  $downloadDir = 'downloads';
  $link_html = '../../demo/admin-template/index.html';
  $file = download_save_file($link_html, __DIR__.'/'.$downloadDir.'/'.substr($link_html,6));
  $dom = new DOMDocument();
  @$dom->loadHTML($file);

  function download_save_file ($link, $path){
    $name = substr($link, 6);
    $Download_link = 'https://agileui.com/demo/delight/'.$name;
    $content = file_get_contents($Download_link);
    $folders = explode('/', $path);
    $pop = array_pop($folders);
    $i = '';
    foreach ($folders as $folder){
      $i = $i.$folder.'/';
      if (!is_dir($i)){
        mkdir($i);
      }
    }
    file_put_contents ($i.$pop, $content);
    return $content;
  }

      $links_css = array();
      foreach ($dom->getElementsByTagName('link') as $link_css){
        if ($link_css->getAttribute('rel') == 'stylesheet'){
          $links_css[] = $link_css->getAttribute('href');
          $name_css = substr($link_css->getAttribute('href'), 6);
          $link_css->setAttribute('href', './'.$name_css);
        }
      }

        foreach ($links_css as $link) {
          download_save_file ($link, __DIR__.'/'.$downloadDir.'/'.substr($link, 6));
        }

      $links_js = array();
      foreach ($dom->getElementsByTagName('script') as $link_js){
        $links_js[] = $link_js->getAttribute('src');
        $name_js = substr($link_js->getAttribute('src'), 6);
        $link_js->setAttribute('src', './'.$name_js);
      }

      foreach ($links_js as $link){
        download_save_file($link, __DIR__.'/'.$downloadDir.'/'.substr($link, 6));
      }


?>
