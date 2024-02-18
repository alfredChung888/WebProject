<?php
   // ensure the page is not cached
   require_once("nocache.php");

   // get access to the session variables
   session_start();

   // Now destroy the session
   session_destroy();
   
   if(isset($_GET['errorLoggedIn'])){
  $errorLoggedMsg=$_GET['errorLoggedIn'];
  }

  

   // Redirect the user to the starting page (login.php)
   header("location:index.php?errorLoggedMsg=$errorLoggedMsg");
?>
