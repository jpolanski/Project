<?php
    class TypeRoomController extends ApplicationController {
        
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
