<?php
  $downloadDir = 'downloads';
  $file = file_get_contents('https://agileui.com/demo/delight/demo/admin-template/index.html');
  $dom = new DOMDocument();
  @$dom->loadHTML($file);

  if (!is_dir(__DIR__.'/'.$downloadDir)){
    mkdir(__DIR__.'/'.$downloadDir);
  }
  file_put_contents(__DIR__.'/'.$downloadDir.'/index.html', $file);

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
        if(!empty($link_js->getAttribute('src'))){
          $links_js[] = $link_js->getAttribute('src');
          $name_js = substr($link_js->getAttribute('src'), 6);
          $link_js->setAttribute('src', './'.$name_js);
        }
      }

      foreach ($links_js as $link){
        download_save_file($link, __DIR__.'/'.$downloadDir.'/'.substr($link, 6));
      }

      $links_img = array();
      foreach ($dom->getElementsByTagName('link') as $link_img){
        if($link_img->getAttribute('rel') != 'stylesheet'){
          $links_img[] = $link_img->getAttribute('href');
          $name_img = substr($link_img->getAttribute('href'), 6);
          $link_img->setAttribute('href', './'.$name_img);
        }
      }

      foreach ($dom->getElementsByTagName('img') as $link_img){
          $links_img[] = $link_img->getAttribute('src');
          $name_img = substr($link_img->getAttribute('src'), 6);
          $link_img->setAttribute('src', './'.$name_img);
      }

      foreach ($links_img as $link){
        $download_img = 'https://agileui.com/demo/delight/'.substr($link, 6);
        $folders = explode('/', substr($link, 6));
        $pop = array_pop($folders);
        $i = '';

        foreach ($folders as $folder){
          $i = $i.$folder.'/';
          if (!is_dir(__DIR__.'/'.$downloadDir.'/'.$i)){
            mkdir(__DIR__.'/'.$downloadDir.'/'.$i);
          }
        }
        copy ($download_img, __DIR__.'/'.$downloadDir.'/'.$i.$pop);
      }
      @$dom->saveHTMLFile(__DIR__.'/'.$downloadDir.'/'.substr($link_html,6));
?>
