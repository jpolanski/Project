<?php
    require 'application.php';
    $router = new Router($_SERVER['REQUEST_URI']);

    $router->get('/', array('controller' => 'HomeController', 'action' => 'index'));
    $router->get('/sobre', array('controller' => 'AboutController', 'action' => 'index'));

    $router->load();
?>
