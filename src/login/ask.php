<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../login/404.php");
  exit();
}


unset($_SESSION['username']);
unset($_SESSION['user']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student or Faculty</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="ask.css">
  </head>
  <body>
        
    <div class="container">
        <div>
            <h1>Are You a Student or a Faculty?</h1>
        </div>

        <div class="buttons">
            <a href="login_student.php" class="btn btn-1">STUDENT</a>
            <a href="login_faculty.php" class="btn btn-2">FACULTY</a>
            
        </div>  
    </div> 
  </body>
</html>
<?php

?>