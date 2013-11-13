<?php class Validations {

  public static function notEmpty($value, $key = null, &$errors = null){
    if (empty($value)){
      if ($key !== null && $errors !== null) {
        $msg = 'não deve ser vazio';
        $errors[$key] = $msg;
      }
      return false;
    }
    return true;
  }

  public static function validEmail($email, $key = null, &$errors = null){
    $pattern = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+/';

    if (preg_match($pattern, $email))
      return true;

    if ($key !== null && $errors !== null)
      $errors[$key] = 'não é válido';

    return false;
  }

  public static function uniqueField($value, $field, $table, &$errors = null) {
    $db_conn = Database::getConnection();
    $sql = "select {$field} from {$table} where lower({$field}) = $1";
    $params = array(strtolower($value));
    $resp = pg_query_params($db_conn, $sql, $params);

    if ($row = pg_fetch_assoc($resp)) {
      $errors[$field] = 'já existe um cadastro com esse dado';
      return false;
    }
    return true;
  }
  
  public static function roomAvalible(){
    $db_conn = \Database::getConnection();
    $sql = "SELECT COUNT(numberic) as number FROM rooms WHERE status = 'f' " ;
    $result = pg_query($db_conn, $sql) ;
    $value = pg_fetch_assoc($result) ;

    return ($value['number'] > 0) ;  

  }
  

  public static function isEmptyContacts(){
    $db_conn = \Database::getConnection();
    $sql = "SELECT COUNT(id) as number FROM contacts ";
    $result = pg_query($db_conn, $sql) ;
    $value = pg_fetch_assoc($result) ;

    return ($value['number'] == 0) ;  

  }
}
?>
