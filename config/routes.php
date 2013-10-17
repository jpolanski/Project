<?php
    require 'application.php';
    $router = new Router($_SERVER['REQUEST_URI']);

    $router->get('/', array('controller' => 'HomeController', 'action' => 'index'));

    //Informações do hotel
    $router->get('/sobre', array('controller' => 'AboutController', 'action' => 'index'));

    //Formulario de contato
    $router->get('/fale-conosco', array('controller' => 'ContactsController', 'action' => '_new'));
    $router->post('/fale-conosco',array('controller' => 'ContactsController' , 'action' => 'send'));

    $router->load();
?>
