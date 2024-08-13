<?php 

/** @var $pdo \PDO */
require_once "database.php";


//get user information from student table
$statement2=$conn->prepare('SELECT *
                            FROM student 
                            WHERE user_id=:userid');
$statement2->bindValue(':userid',$userid);
$statement2->execute();
$student2=$statement2->fetchAll(PDO::FETCH_ASSOC);
foreach($student2 as $s){
    $student_id=$s['student_id'];
    $firstname=$s['firstname'];
    $lastname=$s['lastname'];
    $email=$s['email'];
    $contact_number=$s['contact_number'];
    $university=$s['university_name'];
    $dept=$s['dept'];
    $city=$s['city'];
    $cgpa=$s['cgpa'];
    $date_of_birth=$s['date_of_birth'];
    $semester=$s['current_semester'];
    $cc=$s['credit_completed'];
    $gender=$s['gender'];
}

//get user's running course information
$statement3=$conn->prepare('SELECT *
                            FROM running_course
                            WHERE student_id=:id');
$statement3->bindValue(':id',$userid);
$statement3->execute();

$student3=$statement3->fetchAll(PDO::FETCH_ASSOC);


?>
