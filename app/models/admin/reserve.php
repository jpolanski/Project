<?php
    
    namespace Admin ;

    class Reserve extends \Base {
        
        private $operator ;
        private $room ;
        private $client;        
        private $dataInput ;
        private $dataOutput ;
        private $visible ;
        


        public function getRoom(){
            return $this->room ;
        }

        public function setRoomNumberic($room){
            $this->room = \Room::findById($room) ;
        }

        public function getOperator(){
            return $this->operator ;
        }

        public function setOperatorId($operator){
            $this->operator = \User::findById($operator) ;

        }

        public function setClientId($client){            
            $this->client = \Client::findById($client) ;
        }

        public function getClient(){
            return $this->client ;
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
        
        public function getVisible(){
            return $this->visible ;
        }
        
        public function setVisible($visible){
            $this->visible = $visible ;
        }
        

        
        public function validates() {
            \Validations::validDate($this->data_input,'date input',$this->errors);
        }

        public function save(){
            if($this->isValid()){
              $reserve =  \Interage::insert('reserves',array('operator_id' => $this->operator->getId(), 
                    'room_numberic' => $this->room->getNumberic(), 
                    'client_id' => $this->client->getId() ,
                    'data_input' => $this->data_input ,
                    'data_output' => $this->data_output
                    
                ));
                $db_conn = \Database::getConnection();
                $numberic = (int)$this->room->getNumberic() ;
                $sql = "UPDATE rooms SET status = 't' WHERE numberic = $numberic " ;
                return  pg_query($db_conn, $sql) ;
            }
        }

        public static function all($visible = 't'){            
            $all = \Interage::select('reserves',array('*'), "visible = '$visible' ") ;
            if($all == null){
                return null ;
            }

            foreach($all as $one){
                $list[] = new Reserve($one) ;
            }

            return $list ;
        }

        public static function findById($id){
            $new = \Interage::select('reserves', array('*'),"id = $id");
            
            return new Reserve($new[0]);
        }
        
        public function destroy(){                        
            $db_conn = \Database::getConnection() ;
            $numberic = (int)$this->room->getNumberic() ;
            $sql = "UPDATE rooms SET status = 'f' WHERE numberic = $numberic " ;
            $update = pg_query($db_conn,$sql);            
            $delete = \Interage::delete('reserves', "id = $this->id");

            if ($update != null && $delete != null){
                return true ;
            }
            else {
                return false ;
            }

        }

        public function notVisible(){
            $db_con = \Database::getConnection();
            $id = (int)$this->getId();
            $sql = "UPDATE reserve SET visible = 'f' WHERE id = $id ";
            return pg_query($db_con,$sql);
        }

        public function update(){
            

        }

        public function saveAndReturnningId(){
            if($this->isValid()){
              $id = $reserve =  \Interage::insert('reserves',array('operator_id' => $this->operator->getId(), 
                    'room_numberic' => $this->room->getNumberic(), 
                    'client_id' => $this->client->getId() ,
                    'data_input' => $this->data_input ,
                    'data_output' => $this->data_output), "RETURNING id ");
                $db_conn = \Database::getConnection();
                $numberic = (int)$this->room->getNumberic() ;
                $sql = "UPDATE rooms SET status = 't' WHERE numberic = $numberic " ;
                $result = pg_query($db_conn, $sql) ;
                
                $id = \Interage::select('reserves', array("MAX(id)"));
                return $id[0]['max'] ;
            }
        }
    }
?>
