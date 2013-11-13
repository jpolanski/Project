<?php
    namespace Admin ;
    class Reserve extends \Base {
        
        private $operator_id ;
        private $room_numberic ;
        private $client_id ;
        private $data_input ;
        private $data_output ;
        
        
        public function getRoomNumberic(){
            return $this->room_numberic ;
        }

        public function setRoomNumberic($room_numberic){
            $this->room_numberic = $room_numberic ;
        }

        public function getOperatorId(){
            return $this->operator_id ;
        }

        public function setOperatorId($operator_id){
            $this->operator_id = $operator_id ;

        }

        public function setClientId($client_id){
            $this->client_id = $client_id ;
        }

        public function getClientId(){
            return $this->client_id ;
        }

        public function getDataOutput(){
            return $this->data_output ;
        }

        public function setDataOutput($data_output){
            $this->data_output = $data_output ;
        }

        public function getDataInput(){
            return $this->data_input ;
        }

        public function setDataInput($data_input){
            $this->data_input = $data_input ;
        }


        
        public function validates() {
        }

        public function save(){
            if($this->isValid()){
              $reserve =  \Interage::insert('reserves',array('operator_id' => $this->operator_id, 
                    'room_numberic' => $this->room_numberic, 
                    'client_id' => $this->client_id ,
                    'data_input' => $this->data_input ,
                    'data_output' => $this->data_output
                ));

                $db_conn = \Database::getConnection();
                $sql = "UPDATE rooms SET status = 't' WHERE numberic = $this->room_numberic " ;
                return  pg_query($db_conn, $sql) ;

              
            }
            
        }

        public static function all(){            
            $all = \Interage::select('reserves',array('*')) ;
                  
            if($all != null)
                {return $all;}
            else {return false ;}            
        }

        public static function findById($id){
            $db_conn = \Database::getConnection() ;
            $sql = "SELECT * FROM  reserves WHERE id = $id " ;
            $new = pg_query($db_conn,$sql);
            
            while($row = pg_fetch_array($new)){
                foreach($row as $field => $value){
                    if(!is_numeric($field)){
                        $newObj[$field] = $value ;
                    }
                }
            }
            
            
            return new Reserve($newObj);          
        }

        public function searchDetails(){
            if(!empty($this->client_id)){
            $result = \Interage::select('client',array('*'), "id = $this->client_id");
            $new['client'] = pg_fetch_assoc($result) ;
            }

            if(!empty($this->operator_id)){
            $result = \Interage::select('operators',array('name'), "id = $this->operator_id");
            $new['operator'] = pg_fetch_assoc($result) ;
            }
            if(!empty($this->room_numberic)){
            $result = \Interage::select('rooms', array('typeroom', 'numberic'), "numberic = %this->room_numberic");
            $new['room'] = pg_fetch_assoc($result) ;            
            }
            return $new ;
        }

        public function destroy(){
                        
            $db_conn = \Database::getConnection() ;
            $sql = "UPDATE rooms SET status = 'f' WHERE numberic = $this->room_numberic " ;
            $update = pg_query($db_conn,$sql);
            $delete = \Interage::delete('reserves', "id = $this->id");

            if ($update != null && $delete != null){
                return true ;
            }
            else {
                return false ;
            }

        }
    }
?>
