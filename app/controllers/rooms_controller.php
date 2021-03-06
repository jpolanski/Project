<?php
    class RoomsController extends ApplicationController {
    
        public function index () {
            $result = Room::readRoom($this->params[':type']) ;
            $photos = Room::searchPhotos($this->params[':type']); 
            $this->render(array('view' => 'rooms/index.phtml', 'room' => $result , 'photos' => $photos));
        }

        public function create() {
            $typeroom = new TypeRoom($this->params['typeroom']) ;
            if ($typeroom->create()) {
                Flash::message('success','Cadastrado com sucesso') ;
                redirect_to('/') ;
            }
            else {                
                Flash::message('danger','Erro no cadastro') ;
                //               $this->render(array('view' => '')); 
                redirect_to('/') ;
            }
        } 
    }
?>
