<?php 
	namespace Admin ;

	class Category extends \Base{

		private $name ;
		private $description ;

		public function getName(){
			return $this->name ;			
		}

		public function setName($name){
			$this->name = $name ;
		}

		public function getDescription(){
			return $this->description ;
		}

		public function setDescription($description){
			$this->description = $description ;
		}

		public function validates(){

		}

		public static function findById($id){
			$new = \Interage::select('categories',array('*'), "id = $id");
			return new Category($new) ;
		}

	}

 ?>