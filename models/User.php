<?php

$connect = $_SESSION["connect"];


require_once('Schema.php');
 
function findIndex($arr, callable $calbackk){
  $index = -1;

  foreach($arr as $key=>$value){
    if(gettype($key) == "integer"){
      $existIndex = $calbackk($value);
      if($existIndex){
        $index = $existIndex;
      }
    } 
    $existIndex = $calbackk([$key=>$value]);
    if($existIndex){
      $index = $existIndex;
    }
  }
  return $index;
}


$userSchema = new Schema([
  "id"=> [
    "type"=>"INT(11)",
    "AI"=> true,
    "NN"=>true,
    "PK"=>true,
  ],
  "username"=> [
    "type"=>"VARCHAR(100)",
    "NN"=>true
  ],
  "email"=> [
    "type"=>"VARCHAR(100)",
    "NN"=>true
  ],
  "avatar"=>[
    "type"=> "VARCHAR(200)",
    "default"=>""
  ],
  "password"=> [
    "type"=>"VARCHAR(100)",
    "NN"=>true
  ],
  "createdAt"=> [
    "type"=>"DATETIME",
    "default"=>"CURRENT_TIMESTAMP"
  ],

  ], [ "schemaName"=> "users"]
);



class User{
  function __construct($userData)  {
    global $userSchema;
    $this->userSchema=$userSchema;

    $provideField = [];

    foreach($userData as $key=> $value){
      array_push($provideField, $key);
    }
   
    $sc = $userSchema->needField;

    $sql = "INSERT INTO $userSchema->schemaName (";
    $sqlVal = "VALUES( ";
    function calcuteDataType($data){
      if(gettype($data) === "string"){
        return "'$data'";
      } 
      return $data;
    }

    foreach($sc as $key=>$value){
      $exist = findIndex($provideField, fn($item)=> $item === $key);
      if($exist !== -1){

        $sql =  $sql . " $key, ";

        $f = calcuteDataType($userData[$key]);
        $sqlVal =  $sqlVal ." $f , ";
      }
    }
  
    function clearLastComma($str){
      $sql = $str . ")";
      return str_replace(", )", ")", $sql);
    }

  
    $val = clearLastComma($sql) ." ". clearLastComma($sqlVal);
    $this->insert = $val;
  }


  public function save(){
    global $connect;
    return $connect->query($this->insert);
    // echo json_encode( $this->insert);
  }

  public function createOne(){

  }

}


