<?php
    class Room extends Base {
        
        private $numberic ;
        private $description ;
        private $status ;
        private $dailyValue ;
        private $type ;


        public function getNumberic() {
            return $this->numberic ;
        }

        public function setNumberic($numberic) {
            $this->numberic = $numberic ;
        }

        public function getDescription() {
            return $this->description ;
        }

        public function setDescription($description) {
            $this->description = $description ;
        }

        public function setStatus($status){
            $this->status = $status ;
        }

        public function setDailyValue($dailyValue) {
            $this->dailyValue = $dailyValue ;  
        }

         public function getDailyValue() {
            return $this->dailyValue ;
        }

        public function setType($type){
            $this->type = $type ;
        }

        public function getType(){
            return $this->type ;
        }
        
        public static function readRoom($type) {
            $db_conn = Database::getConnection();
            $sql = "SELECT * FROM typerooms WHERE type = '{$type}' " ;
            $result = pg_query($db_conn,$sql);            
            return $result ;
        }

        public static function searchPhotos($type) {
            $db_conn = Database::getConnection();
            $sql = "SELECT photo FROM photorooms WHERE type = '$type' " ;
            $result = pg_query($db_conn,$sql);            
            return $result ;
        }

        public static function listFree($type){
            $rooms = Interage::select('rooms',array('numberic'), "status = 'f' and type = '$type' ");            
            return $rooms ;
        }

        public static function findById($id){
            $room = \Interage::select('rooms', array('*'), "numberic = $id");
            return new Room($room[0]) ;
        }

    } 
?>
