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

    //Login e Logout
   $router->get('/login',array('controller' => 'SessionsController' , 'action' => '_new'));
   $router->post('/login',array('controller' => 'SessionsController' , 'action' => 'create'));
   $router->get('/logout',array('controller' => 'SessionsController' , 'action' => 'destroy'));

   //Admin
   $router->get('/admin',array('controller' => 'AdminController' , 'action' => 'index')); 

   //Cadastrar

   $router->get('/admin/cadastrar',array('controller' => 'RegisterController' , 'action' => 'index')); 
   $router->get('/admin/cadastrar/:form',array('controller' => 'RegisterController' , 'action' => 'index')); 

   //Efetuando cadastros especificos
   $router->post('/admin/cadastrar/tipo-de-quarto',array('controller' => 'RoomController' , 'action' => 'create'));


    //Mensagens do admin
   $router->get('/admin/mensagens',array('controller' => 'ContactsController' , 'action' => 'show')); 

    $router->load();
?>
