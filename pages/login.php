<?php

session_start();

// delete it submit name=logout
if(@$_POST["logout"]){
  session_unset();
  session_destroy();
  header("location", "/pages/login.php");
} 

elseif(@$_POST["login"]){
    echo '<span class="h40"></span>';
    list("username"=>$username, "password"=> $password) = $_POST;
    if($username === "RaseL" && $password === "123"){
      $_SESSION["expire"] =  time() + 60;
      $_SESSION["is_Authenticated"] = true;
    } else {
      $_SESSION["is_Authenticated"] = false;  
    }
  
    // echo "loging try ".  $_SESSION["is_Authenticated"];
} 

else{
  // echo '<span class="h40"></span>';
  // echo "status :  ---", $_SESSION["expire"];

  if($_SESSION["expire"] < time()){
    session_unset();
    session_destroy();
  }
  // echo phpinfo();
}

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Page</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/asserts/fontawesome-pro-5.12.0-web/css/all.css">
</head>

<body>

<div id="backdrop"></div>

<!-- navigation start -->
<header>
   <nav class="main_nav">
   <a href="/index.php">Home</a>
    <a href="/pages/login.php">Login</a>
    <a href="/pages/about.php">About</a>
   </nav>

    <div class="auth_menu">
      
      <?php 
        if($_SESSION["is_Authenticated"]){
          echo '<img src="/asserts/images/avatar-1.3921191a.jpg" alt="">' ;
        } else{
          echo '
            <a href="/pages/login.php"> <i class="sign_in_icon far fa-sign-in-alt"></i></a>
          ';
        }
      
      ?>

      <div class="dropdown_panel">
       <ul>
         <li class="dropdown_item">
           <i class="far fa-user-circle" aria-hidden="true"></i>
            <a href="/profile">Profile</a>
         </li>
         <li class="dropdown_item">
           <i class="far fa-home" aria-hidden="true"></i>
            <a href="/profile">Home</a>
         </li>
         <li class="dropdown_item">
           <i class="far fa-address-card" aria-hidden="true"></i>
            <a href="/profile">Dashboard</a>
         </li>
         <li class="dropdown_item">
           <i class="far fa-sign-out-alt" aria-hidden="true"></i>
            <form method="post"><input name="logout" type="submit" value="Sign out" /></form>
         </li>
       </ul>
      </div>

    </div>
  </header>
  <span class="h40"></span>
<!-- navigation End -->


  <!-- Container start -->
  <div class="container">

    <h1>Login Form</h1>
      <form method="POST">
        <label>Enter Your Name: </label>
        <input name="username" />
        <br />
        <label>Enter Your Password: </label>
        <input name="password" />
        <br>
        <input name="login" type="submit" value="show my name" />
      </form>
    </div>



<!-- Container End -->


  
  <script src="/index.js"></script>
  <script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:81/browser-sync/browser-sync-client.js?v=2.26.12'><\/script>".replace("HOST", location.hostname));
//]]></script>

</body> 

</html> 


<h2>Hello</h2>
