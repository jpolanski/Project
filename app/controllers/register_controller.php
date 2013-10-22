<?php
    class RegisterController extends ApplicationController {
        
        public function index() {

            $forms = array('tipo-de-quarto' => '_form_room.phtml' ,
                           'usuario' => '_form_user.phtml', 
                           'servico' => '_form_service.phtml',
                           'produto' => '_form_product.phtml',
                           'cliente' => '_form_client.phtml' ,
                           '' => '_default.phtml'

                       ) ;
            if (isset($this->params[':form']))
                $this->render(array('view' => 'admin/register/index.phtml', 'form' => $forms[$this->params[':form']]));
            else                
                $this->render(array('view' => 'admin/register/index.phtml', 'form' => $forms['']));
        }
    
    }
?>
