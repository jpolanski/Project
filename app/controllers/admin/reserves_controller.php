<?php
    namespace Admin ;

    class ReservesController extends ApplicationController {
        
        public function index(){
            $this->render(array('view' => 'admin/reserves/index.phtml',
                 'reserves' => Reserve::all())) ;
        }



        public function show(){
        	$reserve = Reserve::findById($this->params[':id']) ;
        	$this->render(array('view' => 'admin/reserves/show.phtml','reserve' => $reserve));
        }

        public function _new(){
            if(\Validations::roomAvalible()) {
            if(isset($client)) {
                $this->render(array('view' => 'admin/reserves/new.phtml', 
                                    'reserve' => new Reserve(),
                                    'rooms' => \Room::listFree()));
            }
            else {                
                $this->render(array('view' => 'admin/reserves/client.phtml'));
            }
            }

            else {
                \Flash::message('info', 'Não existem quartos disponiveis no momento');
                $this->redirect_to($this->back());
            }
        }

        public function create(){            
            $_POST['reserve']['client_id'] = $_POST['client']['id'] ;
            $reserve = new Reserve($_POST['reserve']);            
            
            if($reserve->save()){
                \Flash::message('success', 'Reserva realizada com sucesso !!!');
                $this->redirect_to('/admin/reservas');
            }
            else {
                \Flash::message('danger', 'Erro ao realizar a reserva');
                $this->redirect_to($this->back());   
            }
        }

        public function edit(){
            $reserve = Reserve::findById($this->params[':id']);            
            $client = \Client::findById($reserve->getClient()->getId());

            $this->render(array('view' => 'admin/reserves/edit.phtml',
                'reserve' => $reserve,'client' => $client ,
                'rooms' => \Room::listFree()));
        }

        public function update(){            
            $reserve = new Reserve($this->params['reserve']);
            if($reserve->update()){
                \Flash::message('success', 'Reserva atualizada com sucesso !!!');
                $this->redirect_to('/admin/reservas');
            }
            else {
                \Flash::message('danger', 'Ocorreu um erro durante a atualização');
                $this->redirect_to($this->back());   
            }
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

        // Faz a busca do cliente
        public function search(){
            if(\Validations::roomAvalible()){
            $client  = \Client::findByCpf($this->params['cpf']);
            $rooms = \Room::listFree($this->params['typeroom']) ;
            

            if (!empty($rooms)) {
            $this->render(array('view' => 'admin/reserves/new.phtml',
                                'client' => $client,
                                'rooms' => $rooms ,                                 
                                'reserve' => new Reserve() 

            ));

            } 
            else {
                \Flash::message('danger', 'Não existem quartos desse tipo dísponiveis');
                $this->redirect_to($this->back());
            }   


            } 
            else {
                \Flash::message('info', 'Não existem quartos disponiveis no momento');
                $this->redirect_to($this->back());
            }
        }


    }
?>
