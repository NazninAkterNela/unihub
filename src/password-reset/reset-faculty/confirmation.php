<?php
session_start();


$username = $_SESSION['username']; //get userID
$_SESSION['username']=$username;


require_once "../../data/database.php"; 

if($_SERVER['REQUEST_METHOD']==="POST"){
    //get userID and check validation
    $a=$_POST['a'];
    $b=$_POST['b'];
    $c=$_POST['c'];
    $d=$_POST['d'];
    $_code = $a.$b.$c.$d;
    print($_code);

    $statement=$conn->prepare('SELECT 2FA_code
                            FROM teacher_user 
                            WHERE user_id=:userid');
    $statement->bindValue(':userid',$username);
    $statement->execute();
    $user=$statement->fetchAll(PDO::FETCH_ASSOC);
    //if code doesn't match then return 
    foreach($user as $user1){
        if($user1['2FA_code']!=$_code){  
            header('location: forgot-password-faculty.php');
            exit;
        }
    }
    header('location: new-password-faculty.php');
    exit;
   

}

?>
