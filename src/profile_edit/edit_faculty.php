<?php 

session_start();
$userid=$_SESSION['username'];

    require_once "../data/database.php";
    //echo $userid;
    $errors=[];


    if(!$userid){
      header('Location:../profile/profile_faculty.php');
      exit;
    }

    $statement = $conn->prepare('SELECT * FROM faculty WHERE user_id= :faculty_id');
    $statement->bindValue(':faculty_id', $userid);
    $statement->execute();
    $faculty = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($faculty as $f){
      $email=$f['email'];
      $contact_number=$f['contact_number'];
      $city=$f['city'];
      $experience=$f['experience'];
      $works_for=$f['works_for'];
      $research=$f['research'];
      $dept=$f['dept'];
      $gender=$f['gender'];
    }

    if ($_SERVER["REQUEST_METHOD"]==="POST"){

        $email=$_POST['Inputemail'];
        $phone_no=$_POST['Inputcontact_number'];
        $city=$_POST['Inputcity'];
        $experience=$_POST['Inputexperience'];
        $works_for=$_POST['Inputworks_for'];
        $research=$_POST['Inputresearch'];
        $dept=$_POST['Inputdept'];
        $gender=$_POST['Inputgender'];


        if(empty($errors)){
                
            $statement1=$conn->prepare("UPDATE faculty
                                SET email =:email, contact_number=:contact_number,city=:city,experience=:experience,
                                works_for=:works_for,research=:research,dept=:dept,gender=:gender
                                WHERE user_id=:user_id ");

                
            $statement1->bindValue(':email',$email);
            $statement1->bindValue(':contact_number',$phone_no);
            $statement1->bindValue(':city',$city);
            $statement1->bindValue(':experience',$experience);
            $statement1->bindValue(':works_for',$works_for);
            $statement1->bindValue(':research',$research);
            $statement1->bindValue(':dept',$dept);
            $statement1->bindValue(':gender',$gender);
            $statement1->bindValue(':user_id',$userid);
            
            $statement1->execute();

            header("Location:../profile/profile_faculty.php");
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
      <form action="edit_faculty.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="Inputemail" value=<?php echo $email?>>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your phone no" name="Inputcontact_number" value=<?php echo $contact_number?>>
          </div>
          <div class="input-box">
            <span class="details">City</span>
            <input type="text" name="Inputcity" value=<?php echo $city?>>
          </div>
          <div class="input-box">
            <span class="details">Experience</span>
            <input type="text" placeholder="Work Experience" name="Inputexperience" value=<?php echo $experience?>>
          </div>
          <div class="input-box">
            <span class="details">At This University For</span>
            <input type="text" placeholder="Years in current university" name="Inputworks_for" value=<?php echo $works_for?>>
          </div>
          <div class="input-box">
            <span class="details">Research</span>
            <input type="text" placeholder="Current Research on" name="Inputresearch" value=<?php echo $research?>>
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
