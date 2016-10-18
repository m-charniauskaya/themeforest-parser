<?php
  class PageParser{
    private $dom;
    private $path;

    public function __construct($link){
      $this->link = $link;
      $this->path = __DIR__.'/downloads';
    }

    public function parse(){
      if (!is_dir($this->path)){
        mkdir($this->path);
      }
      $this->dom = new DOMDocument();
      $this->parseHTML();
      $this->parseCss();
      $this->parseJS();
      $this->parseImg();
    }

    private function saveFile($link, $path){
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
      if (!is_file($i.$pop)){
        if (is_string($content)){
          file_put_contents ($i.$pop, $content);
        } else {
          copy ($Download_link, $this->path.'/'.$i.$pop);
        }
      }
      $this->dom->saveHTMLFile($this->path.'/index.html');
    }

    private function parseHTML(){
      $HTML = file_get_contents($this->link);
      @$this->dom->loadHTML($HTML);
      file_put_contents($this->path.'/index.html', $HTML);
    }

    private function parseCss(){
      $links_css = array();
      foreach ($this->dom->getElementsByTagName('link') as $link_css){
        if ($link_css->getAttribute('rel') == 'stylesheet'){
          $links_css[] = $link_css->getAttribute('href');
          $name_css = substr($link_css->getAttribute('href'), 6);
          $link_css->setAttribute('href', './'.$name_css);
        }
      }
      foreach($links_css as $link){
        $this->saveFile($link, $this->path.'/'.substr($link, 6));
      }
    }

    private function parseJS(){
      $links_js = array();
      foreach ($this->dom->getElementsByTagName('script') as $link_js){
        if(!empty($link_js->getAttribute('src'))){
          $links_js[] = $link_js->getAttribute('src');
          $name_js = substr($link_js->getAttribute('src'), 6);
          $link_js->setAttribute('src', './'.$name_js);
        }
      }

      foreach ($links_js as $link){
        $this->saveFile($link, $this->path.'/'.substr($link, 6));
      }
    }

    private function parseImg(){
      $links_img = array();
      foreach ($this->dom->getElementsByTagName('link') as $link_img){
        if($link_img->getAttribute('rel') != 'stylesheet'){
          $links_img[] = $link_img->getAttribute('href');
          $name_img = substr($link_img->getAttribute('href'), 6);
          $link_img->setAttribute('href', './'.$name_img);
        }
      }

      foreach ($this->dom->getElementsByTagName('img') as $link_img){
          $links_img[] = $link_img->getAttribute('src');
          $name_img = substr($link_img->getAttribute('src'), 6);
          $link_img->setAttribute('src', './'.$name_img);
      }

      foreach ($links_img as $link){
        $this->saveFile($link, $this->path.'/'.substr($link, 6));
      }
    }
  }
?>
