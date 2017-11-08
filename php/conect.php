<?php
   include("materia/mysqli_connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {


      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT id FROM usuario WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1)
	  {
        header("location: ../index.html");
      }else
	  {
         $error = "Credenciales inválidas";
      }
   }
?>
