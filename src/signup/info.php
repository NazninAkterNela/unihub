<?php 
    /** @var $pdo\PDO */
    require_once "../data/database.php";

    $statementU=$conn->prepare('SELECT name 
                                FROM university');
    $statementU->execute();
    $universities=$statementU->fetchAll(PDO::FETCH_ASSOC);

    $errors=[];


    $user_id="";
    $university="";


    //check server method
    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        $firstname=$_POST['inputFirstname'];
        $lastname=$_POST['inputLastname'];
        $email=$_POST['inputEmail'];
        $user_id=$_POST['inputUserID'];
        $password=$_POST['inputPassword'];
        $university=$_POST['inputUniversity'];
        $dept=$_POST['inputDept'];
        $gender=$_POST['gender'];

        //password check
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        //check if all the boxes are filled
        if(!$user_id || !$university || !$firstname || !$lastname || !$email || !$password || !$dept )
        {
            
            $errors[]='Please fill in all the room';
        }


        else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
           $errors[]= 'Password should be at least 8 characters in length and should include 
            at least one upper case letter, one number, and one special character.';
        }

    }
?>
