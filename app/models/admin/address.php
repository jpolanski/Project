<?php
    
    class Address extends \Base {
        
        private $street ;
        private $city ;
        private $numberic ;
        
        public function getStreet(){
            return $this->street ;
        }

        public function setStreet($street){
            $this->street = $street ;
        }

        public function getCity(){
            return $this->city ;
        }

        public function setCity($city){
            $this->city = $city ;
        }

        public function setNumberic($numberic){
            $this->numberic = $numberic ;
        }

        public function getNumberic(){
            return $this->numberic ;
        }


        
        public function validates() {
        

        }

        public function save(){
            if($this->isValid()){
              $Address =  \Interage::insert('address',array('street' => $this->street, 
                    'city' => $this->city));         

              if($Address != null){
                return true ;
              } 
              else {
                return false ;
              }
            }
            else {
                return false ;
            }
            
            
        }

        public static function update($id){
            //if($this->isValid()) {
                $db_conn = \Database::getConnection();
                $sql = "UPDATE address SET street = $this->street WHERE id = $id";
                $update = pg_query($db_conn,$sql);
                if($update != null){
                    return true;
                }else{
                    return false;
                }

            //}

        }

        public static function all(){            
            $all = \Interage::select('address',array('*')) ;
                  
            if($all != null)
                {return $all;}
            else {return false ;}            
        }
        /*
        public static function findById($id){
            $db_conn = \Database::getConnection() ;
            $sql = "SELECT * FROM  address WHERE id = $id " ;
            $new = pg_query($db_conn,$sql);
            
            while($row = pg_fetch_array($new)){
                foreach($row as $field => $value){
                    if(!is_numeric($field)){
                        $newObj[$field] = $value ;
                    }
                }
            }
            
            
            return new Address($newObj);          
        }
        */

        public function destroy(){
                        
            $db_conn = \Database::getConnection() ;
            $delete = \Interage::delete('address', "id = $this->id");

            if ($delete != null){
                return true ;
            }
            else {
                return false ;
            }

        }

        //Alteração feita por mim ...

        public static function findById($id){
            $new = \Interage::select('address', array('*'), "id = $id");
            print_r($new);
            die();
            return new Address($new[0]) ;
        }

    }
?>
