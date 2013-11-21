<?php 
	namespace Admin ;

	abstract class ItemProduct extends \Base {

		public 	static function searchProductsConsumed($consumption_id){

		}

		public static function savingProdutcConsumed($consumption_id, $products = array()){
			foreach($products as $product){
				$save = \Interage::insert('itens_products', 
										   array('product_id' => $product->getId() ,
										   'consumption_id' => $consumption_id));
				
				if($save == null){
					return false ;
				}
			}
			return true ;
		}

	}
 ?>