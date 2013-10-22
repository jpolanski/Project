<?php
    require 'application.php';
    $router = new Router($_SERVER['REQUEST_URI']);

    $router->get('/', array('controller' => 'HomeController', 'action' => 'index'));

    //Informações do hotel
    $router->get('/sobre', array('controller' => 'AboutController', 'action' => 'index'));

    //Formulario de contato
    $router->get('/fale-conosco', array('controller' => 'ContactsController', 'action' => '_new'));
    $router->post('/fale-conosco',array('controller' => 'ContactsController' , 'action' => 'send'));

    $router->get('/acomodacoes/:type',array('controller' => 'RoomsController' , 'action' => 'index'));

    // Admin
   $router->get('/login',array('controller' => 'SessionsController' , 'action' => '_new'));
   $router->post('/login',array('controller' => 'SessionsController' , 'action' => 'create'));
   


    $router->load();
?>
