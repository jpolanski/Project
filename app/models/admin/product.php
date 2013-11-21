<?php 
	namespace Admin ;

	class Product extends \Base {

		private $name ;
		private $amout ;
		private $category ;

		public function getName(){
			return $this->name ;
		}

		public function setName($name){
			$this->name = $name ;
		}

		public function getAmount(){
			return $this->amount ;
		}

		public function setAmount($amount){
			$this->amount = $amount ;
		}

		public function setCategoryId($categoryId){
			$this->category = Category::findById($categoryId) ;
		}

		public function getCategory(){
			return $this->category ;
		}

		public function validates(){}

	}
 ?>