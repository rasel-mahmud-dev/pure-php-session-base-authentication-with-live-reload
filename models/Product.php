<?php 
require_once('database/db.php');
require_once('Schema.php');

$connect = $_SESSION["connect"];


$Product = new Schema([
  "id"=> [
    "type"=>"INT(11)",
    "AI"=> true,
    "NN"=>true,
    "PK"=>true,
  ],
  "name"=> [
    "type"=>"VARCHAR(100)",
    "NN"=>true
  ]

  
], [ "schemaName"=> "Products"]
);

