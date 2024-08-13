<?php 

/** @var $pdo \PDO */
require_once "database.php";

//get user information from Faculty table
$statement4=$conn->prepare('SELECT *
                        FROM faculty 
                        WHERE user_id=:userid');
$statement4->bindValue(':userid',$userid);
$statement4->execute();
$faculty1=$statement4->fetchAll(PDO::FETCH_ASSOC);
foreach($faculty1 as $f){
    $faculty_id=$f['faculty_id'];
    $firstname=$f['firstname'];
    $lastname=$f['lastname'];
    $email=$f['email'];
    $contact_number=$f['contact_number'];
    $university=$f['university_name'];
    $dept=$f['dept'];
    $city=$f['city'];
    $experience=$f['experience'];
    $research=$f['research'];
    $gender=$f['gender'];
    $works_for=$f['works_for'];
    $rating=$f['rating'];
}
    

//get faculty's running course information
$statement5=$conn->prepare('SELECT *
                            FROM teaches
                            WHERE faculty_id=:id');
$statement5->bindValue(':id',$userid);
$statement5->execute();

$faculty2=$statement5->fetchAll(PDO::FETCH_ASSOC);

?>