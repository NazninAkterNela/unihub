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
      $email=$s['email'];
      $contact_number=$s['contact_number'];
      $date_of_birth=$s['date_of_birth'];
      $city=$s['city'];
      $cgpa=$s['cgpa'];
      $semester=$s['current_semester'];
      $cc=$s['credit_completed'];
      $dept=$s['dept'];
      $gender=$s['gender'];
    }

    if ($_SERVER["REQUEST_METHOD"]==="POST"){

        $email=$_POST['Inputemail'];
        $contact_number=$_POST['Inputcontact_number'];
        $date_of_birth=$_POST['Inputdate_of_birth'];
        $city=$_POST['Inputcity'];
        $cgpa=$_POST['Inputcgpa'];
        $semester=$_POST['Inputcurrent_semester'];
        $cc=$_POST['Inputcredit_completed'];
        $dept=$_POST['Inputdept'];
        $gender=$_POST['Inputgender'];


        if(empty($errors)){
                
            $statement1=$conn->prepare("UPDATE student
                                SET email =:email, contact_number=:contact_number,date_of_birth=:date_of_birth,city=:city,cgpa=:cgpa,current_semester=:current_semester,
                                credit_completed=:credit_completed,dept=:dept,gender=:gender
                                WHERE user_id=:user_id ");

                
            $statement1->bindValue(':email',$email);
            $statement1->bindValue(':contact_number',$contact_number);
            $statement1->bindValue(':date_of_birth',$date_of_birth);
            $statement1->bindValue(':city',$city);
            $statement1->bindValue(':cgpa',$cgpa);
            $statement1->bindValue(':current_semester',$semester);
            $statement1->bindValue(':credit_completed',$cc);
            $statement1->bindValue(':dept',$dept);
            $statement1->bindValue(':gender',$gender);
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
    <link rel="stylesheet" href="edit.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Edit Profile</div>
    <div class="content">
      <form action="edit_student.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="Inputemail" value=<?php echo $email?>>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your phone no" name="Inputcontact_number" value=<?php echo $contact_number ?>>
          </div>
          <div class="input-box">
            <span class="details">Date of Birth</span>
            <input type="date" id="Birthday" placeholder="Enter your date of birth" name="Inputdate_of_birth" value=<?php echo $date_of_birth ?>>
          </div>
          <div class="input-box">
            <span class="details">City</span>
            <input type="text" name="Inputcity" value=<?php echo $city?>>
          </div>
          <div class="input-box">
            <span class="details">CGPA</span>
            <input type="text" placeholder="Cgpa" name="Inputcgpa" value=<?php echo $cgpa?>>
          </div>
          <div class="input-box">
            <span class="details">Current Semester</span>
            <input type="text" placeholder="Your Current Semester" name="Inputcurrent_semester" value=<?php echo $semester?>>
          </div>
          <div class="input-box">
            <span class="details">Completed Credits</span>
            <input type="text" placeholder="Credits you've Completed" name="Inputcredit_completed" value=<?php echo $cc?>>
          </div>
          <div class="input-box">
            <span class="details">Department</span>
            <select class="form-select InputDept" name="Inputdept">
                <option selected>Select your Department</option>
                <option>CSE</option>
                <option>BBA</option>
                <option>EEE</option>
                <option>BSE</option>
                <option>CE</option>
                <option>AIS</option>
                <option>BSSEDS</option>
                <option>SE</option>
                </select>
            
          </div>  
          <div class="input-box">
            <span class="details">Gender</span>
            <select class="form-select Inputgender" name="Inputgender">
                <option selected>Select</option>
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
                </select>
          </div>
        </div>
        <div class="button">
          <input type="submit" class="btn btn-primary" value="Save">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
