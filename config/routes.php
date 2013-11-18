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

   

   
    //Mensagens do admin
   $router->get('/admin/mensagens',array('controller' => 'Admin\ContactsController' , 'action' => 'index'));     
   $router->get('/admin/mensagens/ler/:id',array('controller' => 'Admin\ContactsController' , 'action' => 'show'));
   $router->get('/admin/mensagens/deletar/:id',array('controller' => 'Admin\ContactsController' , 'action' => 'delete'));

   //Reservas
   $router->get('/admin/reservas',array('controller' => 'Admin\ReservesController' , 'action' => 'index'));
   $router->get('/admin/reservas/:id/detalhes',array('controller' => 'Admin\ReservesController' , 'action' => 'show'));
   $router->get('/admin/reservas/nova',array('controller' => 'Admin\ReservesController' , 'action' => '_new'));
   $router->post('/admin/reservas/nova',array('controller' => 'Admin\ReservesController' , 'action' => 'create'));
   $router->get('/admin/reservas/:id/editar',array('controller' => 'Admin\ReservesController' , 'action' => 'edit'));
   $router->get('/admin/reservas/:id/cancelar',array('controller' => 'Admin\ReservesController' , 'action' => 'destroy'));
   $router->post('/admin/reservas/:id/editar',array('controller' => 'Admin\ReservesController' , 'action' => 'update'));

   //Busca os dados do cliente para uma reserva
   $router->post('/admin/reservas/buscar',array('controller' => 'Admin\ReservesController' , 'action' => 'search'));
   $router->load();
?>
