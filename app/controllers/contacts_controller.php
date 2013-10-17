<?php
    // Ainda faltar salvar o contato na tabela do banco 
    class ContactsController extends ApplicationController {
        
        public function _new () {
            $contact = new Contact () ;
            
            $this->render(array('view' => 'contacts/new.phtml' , 'contact' => $contact )) ;
        }

        public function send () {
            $contact = new Contact ($_POST['contact']) ;
            if ($contact->isValid ()) {
                Flash::message('success', 'Mensagem enviada com sucesso') ;
                $this->redirect_to ('/') ;
            }
            else {

                Flash::message('danger','Existem dados incorretos') ;
                $this->render(array('view' => 'contacts/new.phtml', 'contact' => $contact)) ;
            }
        }
    
    }
?>
