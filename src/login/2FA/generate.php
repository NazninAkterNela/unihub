<?php
    session_start();
    require_once "../../data/database.php"; 
    $usertype = $_SESSION['user']; //get user type
    $userID = $_SESSION['username']; //get userID

    
    //fumction to generate a 4 digit code
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
    //update the 4 digit code in database
    if($usertype='student'){       
        $statement=$conn->prepare(" UPDATE
                                    student_user
                                    SET 
                                    2FA_code = :2FA
                                    WHERE
                                    user_id= :userID");
        $statement->bindValue(':2FA',$_code);
        $statement->bindValue(':userID',$userID);
        $statement->execute();

        //get user mail
        $statement=$conn->prepare("SELECT
                                    email
                                    From
                                    student
                                    where
                                    student_id=:userID");
        $statement->bindValue(':userID',$userID);
        $statement->execute();
        $user=$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($user as $user1){
            $email = $user1['email'];
        }
    }
    if($usertype='faculty'){
        $statement=$conn->prepare(" UPDATE
                                    teacher_user
                                    SET 
                                    2FA_code = :2FA
                                    WHERE
                                    user_id= :userID");
        $statement->bindValue(':2FA',$_code);
        $statement->bindValue(':userID',$userID);
        $statement->execute();
        $user=$statement->fetchAll(PDO::FETCH_ASSOC);
            //get user mail
        $statement=$conn->prepare("SELECT
                                    email
                                    From
                                    faculty
                                    where
                                    faculty_id=:userID");
        $statement->bindValue(':userID',$userID);
        $statement->execute();
        $user=$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($user as $user1){
        $email = $user1['email'];
        print($email);
        
        }
    }


    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../../PHPMailer/Exception.php';
    require '../../../PHPMailer/PHPMailer.php';
    require '../../../PHPMailer/SMTP.php';

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

?>

