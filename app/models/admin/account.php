<?php 
	namespace Admin ;

	class Account extends \Base {
		private $status ;
		private $type ;
		private $valueTotal ;

		public function getStatus(){
			return $this->status ;
		}

		public function setStatus($status){
			$this->status = $status ;
		}

		public function getType(){
			return $this->type ;
		}

		public function setType($type){
			$this->type = $type ;
		}

		public function getValueTotal(){
			return $this->valueTotal ;
		}

		public function setValueTotal($valueTotal){
			$this->valueTotal = $valueTotal ;
		}

		public function validates(){

		}

		public function save(){
			if(!$this->isValid()){return false;}

			$values = array('status' => $this->status , 'type' => $this->type , 'value_total' => $this->valueTotal);	
			$save = \Interage::insert('account',$values);

			return ($save != null) ;		
		}

		public static function findById($id){			
			$new = \Interage::select('accounts', array('*'), " id = $id ");
			return new Account($new[0]) ;
		}

	}
 ?>