<?php abstract class BaseController {

  protected $params;
  protected $beforeAction;

  public function setParams($params) {
    $this->params = $params;
  }

  public function render($data) {
    require 'core/views/views_helpers_functions.php';
    $layout = 'layout/application.phtml';

    if (isset($data['layout']) && $data['layout'])
       $layout = $data['layout'];

    extract($data);
    $view = 'views/'.$view;
    require 'views/'.$layout;
    exit();
  }

  /*
   * Método destinada ao redirecionamento de páginas
   * Lembre-se que quando um endereço inicia-se com '/' diz respeito
   * a um caminho absoluto, caso contrário é um caminho relativo.
   */
  protected function redirect_to($address) {
    if (substr($address, 0, 1) == '/')
      header('location: ' . SITE_ROOT . $address);
    else
      header('location: ' . $address);
    exit();
  }

  /*
   * Retorna o endereço da última página carregada,
   * caso não exista retorna o endereço da página principal da aplicação
   */
  protected function back(){
    if (isset($_SERVER['HTTP_REFERER'])){
      return $_SERVER['HTTP_REFERER'];
    }else{
      return '/';
    }
  }

  public function beforeAction($action) {
    if (sizeof($this->beforeAction) >= 2) {
      $actions = explode(';', $this->beforeAction[0]);
      $method = $this->beforeAction[1];

      if (in_array('all', $actions) || in_array($action, $actions)) {
        $this->$method();
      }
    }
  }

} ?>
