<?php
    /* Classe responsável pela interação com o banco de dados
    *  by: Vinícius Alonso
    * ---------*/
    class Interage {
        
        public static function select($table,$attributes = array(),$where = null){
             if ($attributes[0] == '*') {
                $select = "SELECT * FROM $table " ;
            }
            else {
                $attributes = implode(',',$attributes) ;
                $select = "SELECT {$attributes} FROM $table " ;
            }

            if ($where != null){
              $select .= "WHERE {$where}" ;
            }

        $db_con = Database::getConnection() ;
        $result =  pg_query($db_con,$select) or die('SQL');        
        return $result ;

    
     }


         public static function insert($table, $values = array()){
         foreach($values as $camp => $value){
             is_string($value)? $value = "'$value'" : $value ;
            $text[] = $camp  ;
            $text2[] = $value  ;
         }    
         
         $text = implode(',',$text);  
         $text2 = implode(',',$text2);
         
         $text = '(' . $text . ')' ;
         $text2 = '(' . $text2 . ')' ;
         
         $insert = "INSERT INTO $table {$text} VALUES {$text2} " ;
         $db_con = Database::getConnection(); 
        return pg_query($db_con,$insert) or die('SQL');        
     }


        public static function delete($table,$where){
        $db_con = Database::getConnection();
        $delete = "DELETE FROM $table WHERE {$where} " ;
        return pg_query($db_con,$delete);
    }
    
    }
?>
