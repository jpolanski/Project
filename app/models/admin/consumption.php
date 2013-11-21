<?php 
	namespace Admin ;
	class Consumption extends \Base {

		private $amount ;
		private $type ;
		

		public function getAmout(){
			return $this->amount ;
		}

		public function setAmount($amount){
			$this->amount = $amount ;
		}

		public function getType(){
			return $this->type ;
		}

		public function setType($type){
			$this->type = $type ;
		}

		
		public function validates(){}

		public static function findById($id){
			$new = \Interage::select('consumption',array('*'), "id = $id");
			return new Consumption($new[0]);
		}

		public function listProducts(){
			
		}
	}
 ?>