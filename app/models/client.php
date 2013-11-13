<?php 
  class Client extends Base {

  private $name;
  private $surname; 
  private $cpf;
  private $cnpj ;
  private $mobilephone;
  private $boardvehicle;
  private $fancyName ;
  private $corporateName ;
  private $type ;
  private $landLine ;
  private $addressId ;

  
  public function setName($name) {
    $this->name = $name;
  }
 
  public function getName(){
    return $this->name;
  }

  public function setSurname($surname){
    $this->surname = $surname;
  }
 
  public function getSurname(){
    return $this->surname;
  }
  
  public function setCpf($cpf){
    $this->cpf = $cpf;
 }
 
  public function getCpf(){
    return $this->cpf;
  }

  public function setMobilephone($mobilephone){
    $this->mobilephone = $mobilephone;
  }

  public function getMobilephone(){
    return $this->mobilephone;
  }

  public function setBoardvehicle($boardvehicle){
    $this->boardvehicle = $boardvehicle;
  }
  
  public function getBoardvehicle(){
    return $this->boardvehicle;
  }

  public function getCnpj(){
    return $this->cnpj ;
  }

  public function setCnpj($cnpj){
    $this->cnpj = $cnpj ;
  }

  public function setFancyName($fancyName){
    $this->fancyName = $fancyName ;
  }

  public function setCorporateName($corporateName){
    $this->corporateName = $corporateName ;
  }

  public function setType($type){
    $this->type = $type ;
  }

  public function setLandLine($landLine){
    $this->landLine = $landLine ;
  }

  public function setAddressId($addressId){
    $this->addressId = $addressId ;
  }

  public function validates() {
    Validations::notEmpty($this->name, 'name', $this->errors);    
    Validations::validCpf($this->cpf, 'cpf', $this->errors);    
    Validations::validMobilephone($this->mobilephone, 'mobilephone', $this->errors);
  }


  public static function findById($id){
    $new = \Interage::select('client',array('*'),"id = $id");
    return new Client($new);
  }

  
}?>
