<?php    
    namespace Admin ;
    class ContactsController extends ApplicationController {
        
    
        public function index(){
            $result = \Interage::select('contacts',array('*'));            
            $this->render(array('view' => 'admin/contacts/index.phtml', 'result' => $result));
        }

        public function show(){
            $result = \Interage::select('contacts',array('*'),"id = {$this->params[':id']}");
            $this->render(array('view' => 'admin/contacts/view.phtml', 'result' => $result));        
        }

        public function delete(){
            $id = $this->params[':id'] ;
            if(\Interage::delete('contacts',"id = $id") != null) {
                \Flash::message('success','Mensagem deletada com sucesso.');
                $this->redirect_to('/admin/mensagens');
            } else {
                \Flash::message('danger','Erro');
                $this->redirect_to(back()); 
            }
        }
    }
?>
