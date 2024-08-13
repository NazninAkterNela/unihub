<?php 
session_start();

/** @var $pdo \PDO */
require_once "database.php";

if($_SERVER['REQUEST_METHOD']==="POST"){

    //get userID and check validation
    $userid=$_POST['id'];
    $userpass=$_POST['password'];
    $statement=$conn->prepare('SELECT *
                            FROM teacher_user 
                            WHERE user_id=:userid');
    $statement->bindValue(':userid',$userid);
    $statement->execute();
    $user=$statement->fetchAll(PDO::FETCH_ASSOC);
    if(empty($user)){
        header('location: ../login/login_faculty.php');
        exit;
    }
    else{
        foreach($user as $user1){
            if($user1['password']!=$userpass){  
                header('location: ../login/login_faculty.php');
                exit;
            }
        }
    }
    $_SESSION['username']=$userid;
    $_SESSION['user']="faculty";
    header('location: ../login/2FA/generate.php');
    exit;

}
?>