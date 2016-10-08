<?php
  $file = file_get_contents('https://agileui.com/demo/delight/demo/admin-template/index.html');
  $dom = new DOMDocument();
  @$dom->loadHTML($file);
  $dom->getElementsByTagName('link');

  $downloadDir = 'downloads';
  save_file(__DIR__.'/'.$downloadDir.'/index.html', $file);

  function save_file ($path, $content){
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
          $Download_link_css = 'https://agileui.com/demo/delight/'.$name_css;
          $css = file_get_contents($Download_link_css);
          $name_css = substr($link, 6);
          save_file (__DIR__.'/'.$downloadDir.'/'.$name_css, $css);
        }

      $links_js = array();
      foreach ($dom->getElementsByTagName('script') as $link_js){
        $links_js[] = $link_js->getAttribute('src');
        $name_js = substr($link_js->getAttribute('src'), 6);
        $link_js->setAttribute('src', './'.$name_js);
      }

      foreach ($links_js as $link){
        $Download_link_js = 'https://agileui.com/demo/delight/'.$name_js;
        $js = file_get_contents($Download_link_js);
        $name_js = substr($link, 6);
        save_file (__DIR__.'/'.$downloadDir.'/'.$name_js, $js);
        echo $name_js;
      }



      @$dom->saveHTMLFile(__DIR__.'/'.$downloadDir.'/index.html');

?>
