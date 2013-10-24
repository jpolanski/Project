<?php // namespace admin ;
    class AdminController extends ApplicationController {
        /**
         * Verificações necessárias, verificar se o usuário está logado e se o usuário e administrador
         **/
         protected $beforeAction = array('authenticated' => array('index'));

        public function index() {
            $this->render(array('view' => 'admin/home/index.phtml'));
        }
    }
?>
