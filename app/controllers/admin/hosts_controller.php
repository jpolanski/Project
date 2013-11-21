<?php 

	namespace Admin ;

	class HostsController extends ApplicationController {

		public function index(){
			$this->render(array('view' => 'admin/hosts/index.phtml', 'hosts' => Host::all()));
		}

		public function _new(){					
			$client  = \Client::findByCpf($this->params['cpf']);
			$rooms = \Room::listFree($this->params['typeroom']) ;

			if (!empty($rooms)) {
				$this->render(array('view' => 'admin/hosts/new.phtml',
									'host' => new Host() ,
									'client' => $client,
									'reserve' => new Reserve(),
									'rooms' => $rooms,
									'type' => $this->params['typeroom'] 

				));
			}
			else {

				\Flash::message('danger', 'Não existem quartos desse tipo dísponiveis');
                $this->redirect_to($this->back());
			}	
		}

		public function search(){
			if(\Validations::roomAvalible()){            
            	$this->render(array('view' => 'admin/hosts/client.phtml'));
            } 
            else {
                \Flash::message('info', 'Não existem quartos disponiveis no momento');
                $this->redirect_to($this->back());
            }

		}

		public function create(){
			
			$reserve = new Reserve($_POST['reserve']) ;			
			$id =  $reserve->saveAndReturnningId();
			$reserve->notVisible();						
			$host = new Host();			
			$host->setReserveId($id);
			$host->getReserve()->setVisible('f');
			$host->setAccountId(null);
			$consumption = new Consumption();
			$host->setConsumptionId($consumption);

			if($host->save()){
				\Flash::message('success', 'Hospedagem realizada com sucesso !!!');
				$this->redirect_to('/admin/hospedagens');
			}
			else {
				\Flash::message('danger', 'Erro ao realizar a hospedagem');
				$this->redirect_to('/admin');	
			}
		}

		public function show(){
			$id = $this->params[':id'];
			$new = \Interage::select('hosts', array('*'), "id = $id");
			$host = new Host($new[0]);						
			$this->render(array('view' => 'admin/hosts/show.phtml', 'host' => $host));
		}

		public function destroy(){
			$id = $this->params[':id'] ;
			$new = \Interage::select('hosts',array('*'), "id = $id");
			$host = new Host($new[0]);

			if($host->destroy()){
				\Flash::message('success', 'Hospedagem cancelada com sucesso !!!');
				$this->redirect_to($this->back());
			}
			else {
				\Flash::message('danger', 'Erro ao cancelar a hospedagem');
				$this->redirect_to($this->back());	
			}
		}
	}
?>