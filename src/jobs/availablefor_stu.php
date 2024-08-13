<?php 
session_start();
$userid=$_SESSION['username'];

    require_once "../data/database.php";
    //echo $userid;
    $errors=[];


    if(!$userid){
      header('Location:../profile/profile_student.php');
      exit;
    }

   

    $statement = $conn->prepare('SELECT * FROM student WHERE user_id= :student_id');
    $statement->bindValue(':student_id', $userid);
    $statement->execute();
    $student = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($student as $s){
      $TA=$s['TA'];
      $RA=$s['RA'];
     
    }

    if ($_SERVER["REQUEST_METHOD"]==="POST"){

        $TA=$_POST['InputTA'];
        $RA=$_POST['InputRA'];


        if(empty($errors)){
                
            $statement1=$conn->prepare("UPDATE student
                                SET TA =:TA, RA =:RA
                                WHERE user_id=:user_id ");

                
            $statement1->bindValue(':TA',$TA);
            $statement1->bindValue(':RA',$RA);
            
            $statement1->bindValue(':user_id',$userid);
            
            $statement1->execute();

            header("Location:../profile/profile_student.php");
        }

    }


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="availablefor.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Available For</div>
    <div class="content">
      <form action="" method="POST">
       
        <div class="gender-details">
          <input type="radio" name="InputTA" value="yes" id="dot-1">
          <input type="radio" name="InputTA" value="no" id="dot-2">
          <input type="radio" name="InputTA" value="notyet" id="dot-3"><br>
          <br>
          <span class="gender-title">Are You Available For Teacher's Assistant?</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="InputTA">Yes</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="InputTA">No</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="InputTA">Not Qualified yet</span>
            </label>
          </div>
        </div>
        <br>
        <div class="gender-details">
          <input type="radio" name="InputRA" value="yes" id="dot-4">
          <input type="radio" name="InputRA" value="no" id="dot-5">
          <input type="radio" name="InputRA" value="notyet" id="dot-6"><br>
          <br>
          <span class="gender-title">Are You Available For Research Assistant?</span>
          <div class="category">
            <label for="dot-4">
            <span class="dot four"></span>
            <span class="InputTA">Yes</span>
          </label>
          <label for="dot-5">
            <span class="dot five"></span>
            <span class="InputTA">No</span>
          </label>
          <label for="dot-6">
            <span class="dot six"></span>
            <span class="gender">Not Qualified yet</span>
            </label>
          </div>
        </div>
        <br><br>
        <div class="button">
          <input type="submit" value="Save">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
