<?php class HomeController extends ApplicationController {

   public function index() {
      
      $this->render(array('view' => 'home/index.phtml'));
   }

} ?>
