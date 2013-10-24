<?php
    namespace Admin ;

    class ContactsController extends ApplicationController {
        
        public function index(){
            $result = Interage::select('contacts',array('*'));
            $this->render(array('view' => 'admin/contacts/index.phtml', 'result' => $result));
        }
    }
?>
