<?php    
    /* classe para apresentação
    * by: Vinícius Alonso
     * -------------*/
    class Presents {
    
    //Responsável por alterar os nomes do campos para a apresentação do layout
    private static function alterNameFields($fields = array(),&$original = array()){
        foreach($fields as $key => $value){
            if (in_array($key,$original)) {
                $pos = array_search($key,$original) ;
                $original[$pos] = $value ;
            }
        }    
    }
    
       //Função para preparar a url de edição e delete    
    private static function makeUrl($action , $id){
        $url = explode('/',$_SERVER['REQUEST_URI']) ;
        $x = array_pop($url) ;
        $y = array_pop($url) ;

       return  "/{$y}/{$x}/{$action}/{$id}" ; 
    }


    //Função para fazer as ações da tabela

    private static function actions($actions) {
        foreach($actions as $action){            
            if ($action['method'] == 'GET'){
              echo link_to(Presents::makeUrl($action['url'],$values[$action['id']]),$action['view']) ;
            }
            else {
              extract($action) ;
              include 'templates/_form.phtml' ;
            }
        }        
    }


// Funções para apresentação de conteúdo

 public static function table($content,$fieldsNew = null,$actions = null) {

            $columns = pg_num_fields($content) ;
            while($row = pg_fetch_assoc($content)) {
                foreach($row as $key => $value) {
                  $fields[] = $key ;
                  $values[$key] = $value ;                  
                }
                $other[] = $values ;
                $fields = array_unique($fields);                 
            }
            if ($fieldsNew != null){
                Presents::alterNameFields($fieldsNew,$fields) ;
            }
            require 'templates/_table.phtml' ;
     }

   }

?>
