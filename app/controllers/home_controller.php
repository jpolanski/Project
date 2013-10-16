<?php class HomeController extends ApplicationController {

   public function index() {
      $title = 'Aplicação do MVC adsfasdfads';
      $this->render(array('view' => 'home/index.phtml', 'title' => $title));
   }

} ?>
