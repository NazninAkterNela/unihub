<?php
session_start();
$userid=$_SESSION['username'];
$user=$_SESSION['user'];
//echo $user;
?>
<?php 
require_once "../data/database.php";

$errors=[];

$statement = $conn->prepare('SELECT * FROM student WHERE student.RA= "yes"');

$statement->execute();
$student = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($student as $s){
  $email=$s['email'];
  $contact_number=$s['contact_number'];
  $date_of_birth=$s['date_of_birth'];
  $city=$s['city'];
  $cgpa=$s['cgpa'];
  $semester=$s['current_semester'];
  $cc=$s['credit_completed'];
  $dept=$s['dept'];
  $gender=$s['gender'];
  $TA=$s['TA'];
  $RA=$s['RA'];
  $id=$s['student_id'];
  // $booked=$s['booked'];
     
}
if(!empty($student)){
  foreach($student as $s){
      $name=$s['firstname']." ".$s['lastname'];
      $university=$s['university_name'];
      $id=$s['student_id'];
  }
}
else{
  $error[]='Error';
}

if ($_SERVER["REQUEST_METHOD"]==="POST"){

  header("Location:../profile/profile_faculty.php");
}
else if ($_SERVER["REQUEST_METHOD"]==="POST"){

  $booked=$_POST['Inputbooked'];
 


  if(empty($errors)){
          
      $statement1=$conn->prepare("UPDATE student
                          SET booked =:booked
                          WHERE user_id=:id ");

          
      $statement1->bindValue(':booked',$booked);
      
      $statement1->bindValue(':id',$userid);
      
      $statement1->execute();

      header("Location:../profile/profile_faculty.php");
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
    <div class="title">Available For Research Assistant</div>
    <div class="content">
      <!-- <form action="lookingfor_fac.php"> -->
       <br>
        
        <?php foreach($student as $p): ?>
              <div class="student">
                  <img src="../assets/images/default1.jpg" alt="">

                  <div class="form">
                  <div class="student-details">
                    <form action="../visit_Profile/studentVisit.php" method="GET">
                      <input type="submit" value="<?php echo " ".$p['firstname']." ".$p['lastname'] ?>"><br>
                      Email: <?php echo $p['email'] ?><br>
                      Phone: <?php echo $p['contact_number'] ?><br>
                      Completed Credits: <?php echo $p['credit_completed'] ?><br>
                      <input type="text" name="userProfile" hidden value="<?php echo $p['student_id']?>">
                    </form>
          <!-- </form> -->
                  </div>
                  <form action="lookingfor_TA.php" method="POST">

                  <button type="button" class="btn btn-success" name ="Inputbooked" value="yes">Book</button>

                  </form>
                  
                </div>
            </div>
            <?php endforeach; ?>

        



          <form action="" method="POST">
        <div class="button">
          <input type="submit" value="Go Back">
        </div>  
      </form>
    </div>
  </div>

</body>
</html>
