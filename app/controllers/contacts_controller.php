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
                $contact->save();
                Flash::message('success', 'Mensagem enviada com sucesso') ;
                $this->redirect_to ('/') ;
            }
            else {

                Flash::message('danger','Existem dados incorretos') ;
                $this->render(array('view' => 'contacts/new.phtml', 'contact' => $contact)) ;
            }
        }
    
        public function show(){
            $result = Interage::select('contacts',array('*'));
            $this->render(array('view' => 'admin/contacts/index.phtml', 'result' => $result));
        }

        public function view(){
            $result = Interage::select('contacts',array('*'),"id = {$this->params[':id']}");
            $this->render(array('view' => 'admin/contacts/view.phtml', 'result' => $result));        
        }

        public function delete(){
            $id = $this->params[':id'] ;
            if(Interage::delete('contacts',"id = $id") != null) {
                Flash::message('success','Mensagem deletada com sucesso.');
                $this->redirect_to('/admin/mensagens');
            } else {
                Flash::message('danger','Erro');
                $this->redirect_to(back()); 
            }
        }
    }
?>
