<?php
  /* Inclui arquivos css
   * Se o caminho começar com / deve ser considerado a partir da pasta ASSETS_FOLDER
   * caso contrário a partir de ASSETS_FORLDER/css/
   */
  function stylesheet_include_tag() {
     $params = func_get_args();

     foreach($params as $param) {
        $path = ASSETS_FOLDER;
        $path .= (substr($param, 0, 1) === '/') ? $param : '/css/' . $param ;
        echo "<link href='{$path}' rel='stylesheet' type='text/css' />";
     }
  }

  /*
   * Inclui arquivos js
   * Se o caminho começar com / deve ser considerado a partir da pasta ASSETS_FOLDER
   * caso contrário a partir de ASSETS_FORLDER/css/
   */
  function javascript_include_tag(){
    $params = func_get_args();
    foreach($params as $param){
      $path = ASSETS_FOLDER;
      $path .= (substr($param, 0, 1) === '/') ? $param : '/js/' . $param ;
      echo "<script src='{$path}' type='text/JavaScript'></script>";
    }
  }

  /*
   * Função para criar links.
   * Importante para definir os caminhos dos arquivos
   * Caso começe com / indica caminho absolute a partir do root da aplicação,
   * caso contrário é camaminho relativo
   */
  function link_to($path, $name, $options = '') {
     if (substr($path, 0, 1) == '/')
        $link = SITE_ROOT . $path;
     else
        $link = $path;
     return "<a href='{$link}' {$options}> $name </a>";
  }

  /*
   * Função para criação de urls
   * Importante, pois com elas não é necessário fazer diversas
   * alterações quando mudar a url principal do site
   */
  function url_for($path){
    return SITE_ROOT . $path;
  }

  /*
   * Função para converter boleano em formato amigável
  */
  function pretty_bool($value){
    return $value ? 'Sim' : 'Não';
  }

  function format_date($date){
    return date('d/m/Y h:m:s', strtotime($date));
  }

  function activeClass($key) {
    if (SITE_ROOT . $key == $_SERVER['REQUEST_URI'])
      return 'active';

    return '';
  }

  /* Função para adicionar imagens as páginas
   *  by: Vinícius A.
   */   

   function add_image ($name = null, $path = null,$options = '') {
       if ($name != null && $path != null) {        
            $path = IMAGES_PATH .'/' . $path .'/' . $name ; 
            $img = "<img src='{$path}' {$options} />" ;
       }
       else {
        exit () ;
       }

       return $img ;
   }
?>
