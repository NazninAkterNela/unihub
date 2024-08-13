<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login/404.php");
    exit();
}


$username=$_SESSION['username'];
$user=$_SESSION['user'];
?>


<?php 
/** @var $pdo \PDO */
require_once "../data/database.php";

$searchType="";
$id='';
$error=[];
$uni="";

//fetch universities 
$statementU=$conn->prepare('SELECT name 
                                FROM university');
$statementU->execute();
$universities=$statementU->fetchAll(PDO::FETCH_ASSOC);



if($_SERVER['REQUEST_METHOD']==="POST"){
    $value=$_POST['search'];
    
    if(empty($value)){
        $error[]="Enter value Please";
        
    }

    $searchType=$_POST['search-type'];

    $uni=$_POST['university'];
    //echo $uni;
    
    //for student search
    if($searchType=="student"){
        if(!empty($value)){
            $searchType="student";
            $statement=$conn->prepare('SELECT *
                                        From student
                                        WHERE university_name=:uni 
                                        AND (student_id=:id OR CONCAT(firstname," ",lastname)=:id)');
            $statement->bindValue(':id',$value);
            $statement->bindValue(':uni',$uni);
            $statement->execute();
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($results)){
                foreach($results as $student){
                    $name=$student['firstname']." ".$student['lastname'];
                    $id=$student['student_id'];
                }
            }
            else{
                $error[]='Error';
            }
        }
        else{
            $value=$uni;
            $searchType="universityStudents";
            $statement1=$conn->prepare('SELECT student_id,firstname,lastname,university_name
                                        FROM student
                                        WHERE university_name=:university');
            $statement1->bindValue(':university',$value);
            $statement1->execute();
            $results=$statement1->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                $error[]='Error';

            
            }
        }    
    }

    //for course search
    if($searchType=="course"){
        //value not provided 
        if(empty($value)){
            $searchType="universityCourses";
            $statement1=$conn->prepare('SELECT *
                                        FROM courses c 
                                        WHERE c.dept_name IN (SELECT dept_name 
                                                            FROM department d
                                                            WHERE d.university_name=:university)');
            $statement1->bindValue(':university',$uni);
            $statement1->execute();
            $results=$statement1->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                $error[]='Error';
            }


        }
        else{
            //value provided
            $searchType="course";
            $statement1=$conn->prepare('SELECT *
                                        FROM courses c 
                                        WHERE c.course_id=:id OR c.course_title=:id');
            $statement1->bindValue(':id',$value);
            $statement1->execute();
            $results=$statement1->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                $error[]='Error';
            }
            
                
        }

    }



    //for faculty
    if($searchType=="faculty"){
        $statement2=$conn->prepare('SELECT *
                                    From faculty
                                    WHERE (faculty_id=:id OR CONCAT(firstname," ",lastname)=:id) AND university_name=:uni');
        $statement2->bindValue(':id',$value);
        $statement2->bindValue(':uni',$uni);
        $statement2->execute();
        $results=$statement2->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($results)){
            foreach($results as $faculty){
                $name=$faculty['firstname']." ".$faculty['lastname'];
                $faculty_id=$faculty['faculty_id'];
                $university=$faculty['university_name'];
            }
        }
        else{
            $error[]='Error';

        }
    }


    //for coursemate
    if($searchType==="course mate"){
        $statement=$conn->prepare('SELECT t1.student_id,t1.firstname,t1.lastname,t1.university_name,t2.course_title
                                    FROM student t1
                                    JOIN running_course t2
                                    ON t1.student_id=t2.student_id
                                    WHERE (t2.course_id=:course_id OR t2.course_title=:course_id)
                                    AND t1.university_name=:uni');
        $statement->bindValue(':course_id',$value);
        $statement->bindValue(':uni',$uni);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $person){
            $name=$person['firstname']." ".$person['lastname'];
            $id=$person['student_id'];

        }
        if(empty($results)){
            echo "I am here";
        }
    }
}
//echo $searchType;

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href ="../assets/icons/logo.png" type = "image/x-icon">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="../navigation/navbar.css">
    <link rel="stylesheet" href="search.css">
    
    <title>Search</title>
</head>
<body >

<?php require "../navigation/navbar.php"?>
    

    <section class="containerr">
    
    <h1 class="first-h1">Select your categories</h1>
        <form action="search_S.php" method="POST">
            <div class="university">
                <select name="university" class="form-university">
                    <option selected>Choose your university</option>
                    <?php foreach ($universities as $university): ?>
                        <option ><?php echo $university['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        
            <div class="type">
                <select name="search-type" id="activitySelector" class="form-selectt inputDept">
                    <option selected>Choose a option</option>
                    <option>student</option>
                    <option>faculty</option>
                    <option>course mate</option>
                    <option>course</option>
                </select>
                <label for="" id="search-item"></label>
            </div>
            <!-- <i class="fas fa-search"></i> -->
            <div class='search-bar'> 
                <input type="text"  name="search" id="search-item" placeholder="Search Here">
                <button type="submit" class="btnn" id="search-go">Go</button> 
            </div>
         
        </form>

        <h2 class="results-h2">Results:</h2>
        
        <!-- find student -->
        <?php if($searchType=="student"  && empty($error)): ?>
            <div class="student-list" id="student-list">
            <div class="student">
                <img src="../assets/images/default1.jpg" alt="">

                <div class="student-details">
                    <form action="../visit_Profile/studentVisit.php" method="GET">
                        <input class="student-input-name" type="submit" value="<?php echo $name ?>">
                        <input type="text" class="student-input-id" name="userProfile" value="<?php echo $id ?>">
                    </form>           
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($searchType=="universityStudents" ): ?>
            <?php foreach($results as $person): ?>
            <div class="student">
                <img src="../assets/images/default1.jpg" alt="">

                <div class="student-details">
                   <form action="../visit_Profile/studentVisit.php" method="GET"> 
                        <input class="student-input-name" type="submit"  value="<?php echo $person['firstname']." ".$person['lastname'] ?>">
                        <input type="text" class="student-input-id" name="userProfile" value="<?php echo $person['student_id'] ?>"> 
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>


        <!-- find faculty -->
        <?php if($searchType=="faculty" && $value && empty($error)): ?>
            <div class="student-list" id="student-list">

            <div class="student">
                <img src="../assets/images/default1.jpg" alt="">

                <div class="student-details">
                    <form action="../visit_Profile/facultyVisit.php" method="GET">
                        <input class="student-input-name" type="submit"  value="<?php echo $name ?>">
                        <input type="text" class="student-input-id" name="userProfile2" value="<?php echo $faculty_id ?>"> 
                    </form>
                </div>
            </div>
            </div>
        <?php endif; ?>
        
        


        <!-- find coursemate -->
        <?php if($searchType=="course mate" && $value && empty($error)): ?>
            <?php foreach($results as $person): ?>
                <div class="student">
                <img src="../assets/images/default1.jpg" alt="">

                <div class="student-details">
                    <form action="../visit_Profile/studentVisit.php" method="GET">
                        <input class="student-input-name" type="submit" value="<?php echo $person['firstname']." ".$person['lastname'] ?>">
                        <input type="text" class="student-input-id" name="userProfile" value="<?php echo $person['student_id'] ?>">
                    </form> 
                </div>
             </div>
                 
            </div>
            <?php endforeach; ?>
        <?php endif; ?>



        <!-- find courses -->
        <?php if($searchType=="universityCourses" ): ?>
            <?php foreach($results as $course): ?>
                <form action="coursePage_S.php" method='GET' class="form-course">
                <div class="student course-form">
                    <div class="student-details course-form-details">
                        <h2><input name="course" type="submit" value="<?php echo $course['course_title'] ?>"></h2>
                    </div>
                </div>
                </form>
                
            <?php endforeach; ?>
        <?php endif; ?>
       
        <?php if($searchType=="course"): ?>
            <?php foreach($results as $course): ?>
                <form action="coursePage_S.php" method='GET' class="form-course">
                <div class="student course-form">
                    <div class="student-details course-form-details">
                        <h2><input name="course" type="submit" value="<?php echo $course['course_title'] ?>"></h2>
                    </div>
                </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
    

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../navigation/navbar.js"></script>
</body>
</html>