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

    $statement = $conn->prepare('SELECT * FROM running_course WHERE student_id= :user_id');
    $statement->bindValue(':user_id', $userid);
    $statement->execute();
    $student = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($student as $s){
      $course_id=$s['course_id'];
      $course_title=$s['course_title'];
      $user_id=$s['student_id'];
      
    }

    if ($_SERVER["REQUEST_METHOD"]==="POST"){

        $course_id=$_POST['Inputid'];
        $course_title=$_POST['InputTitle'];
       


        if(empty($errors)){
                
            $statement1=$conn->prepare("INSERT INTO running_courses(course_id,course_title,student_id)
                                VALUES (:course_id,:course_title,:user_id)");

                
            $statement1->bindValue(':course_id',$course_id);
            $statement1->bindValue(':course_title',$course_title);
            $statement1->bindValue(':user_id',$user_id);
            
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
    <div class="title">Add Running Courses</div>
    <div class="content">
      <form action="edit_course.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Course ID</span>
            <input type="text" placeholder="Enter Course ID" name="Inputid" >
          </div>
          <div class="input-box">
            <span class="details">Course Title</span>
            <input type="text" placeholder="Enter Course Title" name="InputTitle" >
          </div>
          
        
        <div class="button">
          <input type="submit" class="" value="Save">
        </div>
      </form>
        
      
    </div>
  </div>

</body>
</html>
