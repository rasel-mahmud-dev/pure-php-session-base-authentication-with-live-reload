<?php 

  $dbHost =  "localhost";
  $dbUsername = 'root';
  $dbUserpssword = '12345';
  $dbname = 'MyDB';

  $connect = new mysqli($dbHost, $dbUsername, $dbUserpssword);

  $dbC = "CREATE DATABASE $dbname";
  if($connect->connect_error){
    die("Database Connection Fail : ". $connect->connect_error);
  } 
  echo "<h4>Database Connected</h4>";


  if(!$connect->select_db($dbname)){
    $sql = "CREATE DATABASE $dbname";
    $connect->query($sql);
  } 

  $connect->select_db("mydb");
  $_SESSION["connect"] = $connect;

  