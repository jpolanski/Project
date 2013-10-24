<?php
    class TypeRoom extends Base {
        
        private $type ;
        private $description ;
        private $dailyValue ;

        public function getType(){
            return $this->type ;
        }

        public function setType($type){
            $this->type = trim($type) ;
        }

       public function getDescription(){
            return $this->description ;
        }

        public function setDescription($description){
            $this->description = trim($description) ;
        }

        public function getDailyValue(){
            return $this->dailyValue ;
        } 

        public function setDailyValue($dailyValue){
            $this->dailyValue = $dailyValue ;
        }

        public function validates(){
            Validations::notEmpty($this->type,'type',$this->errors) ;
            Validations::uniquefield($this->type,'type','typerooms',$this->errors);
            Validations::notEmpty($this->descrition,'description',$this->errors) ;
            Validations::notEmpty($this->dailyValue,'dailyValue',$this->errors) ;        
        }

        public function create(){
            if (!$this->isValid()){
                return false ;
            }
            $db_conn = Database::getConnection();
            $params = array($this->type,$this->description,$this->dailyValue);
            $sql = "INSERT INTO typerooms (type,description,daily_value) VALUES ($1 , $2, $3)";
            return pg_query_params($db_conn,$sql,$params) ;
        }
        
    }
?>
