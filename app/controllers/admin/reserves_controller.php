<?php
    namespace Admin ;

    class ReservesController extends ApplicationController {
        
        public function index(){        	
            $this->render(array('view' => 'admin/reserves/index.phtml',
                'reserves' => Reserve::all())) ;
        }



        public function show(){
        	$reserve = Reserve::findById($this->params[':id']) ;        	
        	$new = $reserve->searchDetails();
            $client = new \Client($new['client']) ;            
        	$this->render(array('view' => 'admin/reserves/show.phtml','reserve' => $reserve, 'client' => $client));
        }

        public function _new(){
            if(\Validations::roomAvalible()) {
            $this->render(array('view' => 'admin/reserves/new.phtml', 
                               'reserve' => new Reserve() ,
                                'rooms' => \Room::listFree() 

            ));

            } 
            else {
                \Flash::message('danger', 'Não existem quartos dísponiveis no momento');
                $this->redirect_to($this->back()) ;
            } 
        }

        public function create(){
            $_POST['reserve']['client_id'] = 1 ;
            $reserve = new Reserve($_POST['reserve']);            
            
            if($reserve->save()){
                \Flash::message('success', 'Reserva realizada com sucesso !!!');
                $this->redirect_to('/admin/reservas');
            }
        }

        public function edit(){
            $reserve = Reserve::findById($this->params[':id']);
            //$new = $reserve->searchDetails() ;
            //$room = new \Room($new['room']);

            $this->render(array('view' => 'admin/reserves/edit.phtml','reserve' => $reserve));
        }

        public function update(){

        }

        public function destroy(){
            $reserve = Reserve::findById($this->params[':id']);
            if($reserve->destroy()){
                \Flash::message('success', 'Reserva cancelada com sucesso');
                $this->redirect_to('/admin/reservas');
            }
            else {
             \Flash::message('danger', 'Ocorreu um erro ao cancelar a reserva');
                $this->redirect_to($this->back());   
            }
        }


    }
?>
