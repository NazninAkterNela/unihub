<?php 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login/404.php");
    exit();
}



$userid=$_SESSION['username'];
$course_title=$_GET['course'];


/** @var $pdo \PDO */
require_once "../data/database.php";

$statement=$conn->prepare('SELECT *
                            FROM courses
                            WHERE course_title=:course_title');
$statement->bindValue(':course_title',$course_title);
$statement->execute();
$result=$statement->fetchAll(pdo::FETCH_ASSOC);

foreach($result as $course){
    $dept=$course['dept_name'];
    $credit=$course['credit'];
    $course_id=$course['course_id'];

}
                            
$statement2=$conn->prepare('SELECT *
                        FROM teaches t
                        JOIN courses c
                        ON c.course_id=t.course_id
                        WHERE t.course_id=:course_id');
$statement2->bindValue(':course_id',$course_id);
$statement2->execute();
$result2=$statement2->fetchAll(pdo::FETCH_ASSOC);



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../profile/navbar.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="navbarr">
        <?php include "../profile/navbar_F.php"?>
    </section>


    <!-- course information section -->
    <section class="details">
        <form action="" method="post" name="form1" >
            
            <div id="details-edit" class="edit">
                <div>
                    <h2>Course Title:</h2>
                    <input type="text" readonly  class="details-edit" readonly value="<?php echo $course_title ?>">
                </div>
                <div>
                    <h2>Course Code: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputCgpa" class="details-edit" placeholder="Not Provided"  value="<?php echo $course_id ?>">
                </div>
                <div>
                    <h2>Department: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputSemester" class="details-edit" placeholder="Not Provided" value="<?php echo $dept ?>" >
                </div>
                
                <div>
                    <h2>Credit: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputCC" class="details-edit" placeholder="Not Provided" value= "<?php echo $credit ?>">
                </div>     

            </div>
        </form>      
    </section>


    <?php foreach($result2 as $faculty): ?>

        <!-- catch faculty name from faculty table -->
        <?php $faculty_id=$faculty['faculty_id'];?>
        <?php $statement3=$conn->prepare('SELECT *
                        FROM faculty f
                        JOIN teaches t
                        ON f.faculty_id=t.faculty_id
                        WHERE t.faculty_id=:id');
        $statement3->bindValue(':id',$faculty_id);
        $statement3->execute();
        $result3=$statement3->fetchAll(pdo::FETCH_ASSOC);
        foreach($result3 as $faculty){
            $faculty_name=$faculty['firstname']. " ".$faculty['lastname'];
        }?>
    <!-- create a section for every faculty -->
    <section class="details main">
        <form action="" method="post" name="form1" >
            <div class="div1">
                <h1><?php echo $faculty_name?></h1>
            </div>
            <div id="details-edit" class="edit">
                <div>
                    <h2>ID: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputCgpa" class="details-edit" placeholder="Not Provided"  value= "<?php echo $faculty['faculty_id']?>">
                </div>
                <hr>
                <div>
                    <h2>University: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputSemester" class="details-edit" placeholder="Not Provided" value= "<?php echo $faculty['university'] ?>">
                </div>
                <hr>
                <div>
                    <h2>Semester: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputCC" class="details-edit" placeholder="Not Provided" value= "<?php echo $faculty['semester'] ?>">
                </div>  
                <hr>
                <div>
                    <h2>Year: </h2>
                    <input type="text" readonly id="inputCgpa" name="inputCC" class="details-edit" placeholder="Not Provided" value= "<?php echo $faculty['year'] ?>">
                </div>     
            </div>
        </form>      
    </section>
    <?php endforeach; ?>
    


    

   
        
        

    


    


    
    <script src="profile.js"></script>
    <script src="https://kit.fontawesome.com/dba87631dd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>