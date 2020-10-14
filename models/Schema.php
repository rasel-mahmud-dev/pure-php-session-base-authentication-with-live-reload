<?php 

require_once('database/db.php');
$connect = $_SESSION["connect"];



class Schema{
 
  public static $query = [];

  function defaultValue($prop){
    $ty = "";
    if($prop && $prop !== ""){
      $ty = "DEFAULT $prop";
    }
    return $ty;
  }

    public function __construct($object, $currentInstance){
      $this->tableQuery = "";
      $this->needField = $object;
      $this->schemaName = $currentInstance["schemaName"];

      $name = fn($prop) => $prop & $prop;
      // // $Type = fn($prop) => $prop & $prop->type ;
      $AI = fn($prop) => $prop === true ? 'AUTO_INCREMENT' : '' ;
      $NN = fn($prop) => $prop === true ? 'NOT NULL' : '' ;
      $PK = fn($prop) => $prop === true ? 'PRIMARY KEY' : '' ;

      foreach($object as $key=> $values){
        $g = $name( $object[$key]["type"] );
        $nn = $NN( $object[$key]["NN"]);
        $ai = $AI( $object[$key]["AI"] );
        $pk = $PK( $object[$key]["PK"] );
        $dValue = $this->defaultValue($object[$key]["default"]);
        $this->tableQuery = "$this->tableQuery $key $g $ai $nn $pk $dValue,";
      }
    
      // Schema::$schemaName = $currentInstance["schemaName"];
      $this->tableQuery = " $this->tableQuery )" ;
      array_push( Schema::$query, [$currentInstance["schemaName"]=>$this->tableQuery]);
    }
    

    // only execute when sync method call......
    public static function sync($force=false){ 
      global $connect;

      foreach(Schema::$query as  $values){
        foreach($values as $key=>$val){
          $initialQuery = "CREATE TABLE $key ";
          if($force){
            $connect->query("DROP TABLE IF EXISTS $key");    
            $initialQuery = "CREATE TABLE IF NOT EXISTS $key ";
          }
      
          $a = $initialQuery. "(". $val. " "; 
          $str = str_replace(", )", ")", $a );
          $connect->query($str);    
          // echo $str; 
        }
      }      
    } 

    public function find(){
      return "Find all Users";
    }

}
























// class Schema{

//   function __construct($object, $instanceName){

//     $this->tableQuery = "";
//     $this->currentInstance = "";

//     $name = fn($prop) => $prop & $prop;
//     // $Type = fn($prop) => $prop & $prop->type ;
//     $AI = fn($prop) => $prop === true ? 'AUTO_INCREMENT' : '' ;
//     $NN = fn($prop) => $prop === true ? 'NOT NULL' : '' ;
//     $PK = fn($prop) => $prop === true ? 'PRIMARY KEY' : '' ;


//     foreach($object as $key=> $values){

//       $g = $name( $object[$key]["type"] );
//       $nn = $NN( $object[$key]["NN"]);
//       $ai = $AI( $object[$key]["AI"] );
//       $pk = $PK( $object[$key]["PK"] );
//       $this->tableQuery = "$this->tableQuery $key $g $ai $nn $pk,";
//     }

//     $this->tableQuery = " $this->tableQuery )" ;
//     $this->currentInstance = $instanceName["schemaName"] ;


//     $this->sync($this->tableQuery,  $this->currentInstance);
//   }
  
  
//   public static function sync($tableQuery, $currentInstance ){

//     $initialQuery = "CREATE TABLE IF NOT EXISTS $currentInstance ";
//     $a = $initialQuery. "(". $tableQuery. " ";

//     $str = str_replace(", )", ")", $a );
//     echo $str;

//     global $connect;
//     $connect->query($str);
//   } 
// };


