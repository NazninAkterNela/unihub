<?php
session_start();

/** @var $pdo\PDO */
require_once "../../data/database.php";
$username=$_SESSION['username'];


$errors= [];

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $password = $_POST['password'];

    //password check
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $errors[]= 'Provide strong password';
    }

    if(empty($errors)){
        
        $statement=$conn->prepare(" UPDATE
                                    student_user
                                    SET 
                                    password = :password
                                    WHERE
                                    user_id= :userID");
        $statement->bindValue(':password',$password);
        $statement->bindValue(':userID',$username);
        $statement->execute();
        header('location: ../../about/home.php');
    }
    

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel = "icon" href ="../assets/icons/logo.png" type = "image/x-icon">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <h1>Enter new password</h1>
        <form action="new-password-student.php" method="post">
            <div class="form-control">
                <input type="password" name="password" required>
                <label for="">new password</label>
            </div>
            <button class="btn">submit</button>
        </form>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                    <div ><?php echo $error ?></div>
                <?php endforeach; ?>
            </div>    
        <?php endif; ?>
        
    </div>


    <script src="style.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>