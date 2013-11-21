<?php 
	namespace Admin ;
	class Host extends \Base {

		private $reserve ;				
		private $consumptionId ;
		private $accountId ;

		public function getReserve(){
			return $this->reserve ;
		}

		public function setReserveId($reserveId){			
			$this->reserve = Reserve::findById($reserveId);
		}	


		public function getConsumption(){
			$this->consumption = Consumption::findById($consumptionId);
			return $this->consumption ;
		}

		public function setConsumptionId($consumptionId){			
			$this->consumptionId = $consumptionId ; 
		}

		public function getAccount(){
			return $this->account ;
		}

		public function setAccountId($accountId){
			if(empty($account)){
				$this->account = null ;
			}
			else {            
				$this->account = Account::findById($accountId);
			}
			
		}

		public function validates(){}


		public static function all(){
			$all = \Interage::select('hosts',array('*')) ;
            if($all == null){
                return null ;
            }

            foreach($all as $one){
                $list[] = new Host($one) ;
            }
            return $list ;
		}

		public static function findById($id){
			$new = \Interage::select('hosts', array('*'), "id = $id ");
			return new Host($new[0]);
		}


		public function save(){
			/*
			if($this->account != null){
				$account = $this->account->save() ;
			}

			if($this->consumption != null){
				$consumption = $this->consumption->save();
			}
			*/
			$reserve_id = (int)$this->reserve->getId() ;

			$insert = array(
				'reserve_id' => $reserve_id,
				'consumption_id' => 0 ,#$this->consumptionId->getId(),
				'account_id' => 0 #$this->accountId->getId()
			);
			$host = \Interage::insert('hosts', $insert);
			return $host ;
		}

		public function destroy(){
			$reserve = $this->getReserve()->destroy();
			if(is_object($this->getAccount())){
				$this->accountId->destroy() ;
			}			
			$id = (int)$this->id ;
			$delete = \Interage::delete('hosts', "id = $id");
			return $delete ;
		}

	}
?>
