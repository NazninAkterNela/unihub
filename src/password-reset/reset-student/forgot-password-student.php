<?php

session_start();

/** @var $pdo\PDO */
require_once "../../data/database.php";


$errors= [];

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/Exception.php';
require '../../../PHPMailer/PHPMailer.php';
require '../../../PHPMailer/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST['id'];
    $statementID=$conn->prepare('SELECT student_id,email
                                FROM student
                                WHERE student_id = :username'
                                );
    $statementID->bindValue(':username',$username);
    $statementID->execute();

    $user = $statementID->fetchAll(PDO::FETCH_ASSOC);

    foreach($user as $user1){
        $usename=$user1['student_id'];
        $email = $user1['email'];
    }

    if(empty($user)){
        $errors[]='Invalid username';
    }
    if(empty($errors)){
        $_SESSION['username']=$username;
        $_SESSION['email']=$email;

        //function to generate otp
        function generateRandomString($length) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $_code =generateRandomString(4);

        //update otp in database
        $statement=$conn->prepare(" UPDATE
                                    student_user
                                    SET 
                                    2FA_code = :2FA
                                    WHERE
                                    user_id= :userID");
        $statement->bindValue(':2FA',$_code);
        $statement->bindValue(':userID',$username);
        $statement->execute();

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'unihub@gmail.com';                     //SMTP username
            $mail->Password   = 'ukljzipzqfjucpao';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'UniHub');
            $mail->addAddress($email);     

            

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'verfication code';
            $mail->Body    = 'Your verification code is '.$_code;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            ;
            if($mail->send()){
                echo 'Message has been sent';
                header('location: OTP.php');
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent.";
        }
                
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
        <h1>Enter username</h1>
        <form action="forgot-password-student.php" method="post">
            <div class="form-control">
                <input type="text" name="id" required>
                <label for="">Your ID</label>
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