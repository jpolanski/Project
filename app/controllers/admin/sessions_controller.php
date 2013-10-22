<?php

    class SessionsController extends ApplicationController {
                
        public function index() {
            $this->render(array('view' => 'admin/home/index.phtml'));
        }

    } 
?>
