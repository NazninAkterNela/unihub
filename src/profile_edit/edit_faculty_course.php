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

    $statement = $conn->prepare('SELECT * FROM faculty WHERE faculty_id= :faculty_id');
    $statement->bindValue(':faculty_id', $userid);
    $statement->execute();
    $faculty = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($faculty as $f){
      $university=$f['university_name'];
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $code=$_POST['inputCode'];
        $title=$_POST['inputTitle'];
        $year=$_POST['inputYear'];
        $sem=$_POST['inputSem'];

        if(empty($errors)){
                
            $statement1=$conn->prepare('INSERT INTO teaches(faculty_id,course_title,course_id,year,semester,university)
                                      VALUES (:id,:title,:code,:year,:semester,:uni)');

            echo $userid;
            $statement1->bindValue(':id',$userid);  
            $statement1->bindValue(':title',$title);
            $statement1->bindValue(':code',$code);
            $statement1->bindValue(':year',$year);
            $statement1->bindValue(':semester',$sem);
            $statement1->bindValue(':uni',$university);

            
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
            <span class="details">Course Title</span>
            <input type="text" name="inputTitle" placeholder="Enter course title" value="">
          </div>
          <div class="input-box">
            <span class="details">Course Code</span>
            <input type="text" name="inputCode" placeholder="Enter course code"  value="">
          </div>
          
          <div class="input-box">
          <span class="details">Last taken Year & Semester</span>
          <input type="text" name="InputYeara" placeholder="Enter year"  value="">
            <select class="form-select InputDept" name="InputSem">
              <option selected>Semester</option>
              <option>Summer</option>
              <option>Spring</option>
              <option>Fall</option>
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
