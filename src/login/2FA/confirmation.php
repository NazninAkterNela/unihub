<?php
session_start();
$usertype=$_SESSION['user']; //get user type
$userid = $_SESSION['username']; //get userID
$_SESSION['username']=$userid;
$_SESSION['user']=$usertype;


echo $usertype.$userid;

require_once "../../data/database.php"; 

if($_SERVER['REQUEST_METHOD']==="POST"){
    //get userID and check validation
    $a=$_POST['a'];
    $b=$_POST['b'];
    $c=$_POST['c'];
    $d=$_POST['d'];
    $_code = $a.$b.$c.$d;
    print($_code);

    //IF user is a student
    if($usertype=='student'){
        $statement=$conn->prepare('SELECT 2FA_code
                         FROM student_user 
                        WHERE user_id=:userid');
        $statement->bindValue(':userid',$userid);
        $statement->execute();
        $user=$statement->fetchAll(PDO::FETCH_ASSOC);
        //if code doesn't match then return 
        foreach($user as $user1){
            if($user1['2FA_code']!=$_code){  
                header('location: generate.php');
                exit;
            }
        }
        $time = date("h:i:sa"). " " . date("Y/m/d");
        //insert logging info into logger table
        $statement2=$conn->prepare("INSERT INTO 
                                    logger(username,time)
                                    VALUES
                                    (:username,:time)");
        $statement2->bindValue(':username',$userid);
        $statement2->bindValue(':time',$time);
        $statement2->execute();

        if($userid=="admin"){
            header('location: ../../profile/profile_admin.php');
            exit;
        }
        //else go to student profile
        $_SESSION['username']=$userid;
        $_SESSION['user']="student";
        
        header('location: ../../profile/profile_student.php');
        exit;
    }
    
    //if user is a faculty
    if($usertype=='faculty'){
        $statement=$conn->prepare('SELECT 2FA_code
        FROM teacher_user 
        WHERE user_id=:userid');
        $statement->bindValue(':userid',$userid);
        $statement->execute();
        $user=$statement->fetchAll(PDO::FETCH_ASSOC);

        
        //code doesn't match then return
        foreach($user as $user1){
            if($user1['2FA_code']!=$_code){  
                header('location: generate.php');
                exit;
            }
        }
        $time = date("h:i:sa"). " " . date("Y/m/d");
        //insert logging info into logger table
        $statement2=$conn->prepare("INSERT INTO 
                                    logger(username,time)
                                    VALUES
                                    (:username,:time)");
        $statement2->bindValue(':username',$userid);
        $statement2->bindValue(':time',$time);
        $statement2->execute();
        //else go to faculty profile
        $_SESSION['username']=$userid;
        $_SESSION['user']="faculty";
        header('location: ../../profile/profile_faculty.php');
        exit;
    }
   

}

?>
