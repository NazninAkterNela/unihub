<?php

/** @var $pdo\PDO */
require_once "../data/database.php";

$statementU = $conn->prepare('SELECT name 
                                FROM university');
$statementU->execute();
$universities = $statementU->fetchAll(PDO::FETCH_ASSOC);

$errors = [];


$user_id = "";
$university = "";


//check server method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

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

    //check if userID is unique
    //check if userID is unique
    $statementID = $conn->prepare(
        'SELECT user_id
                                    FROM teacher_user
                                    WHERE user_id = :username'
    );
    $statementID->bindValue(':username', $user_id);
    $statementID->execute();

    $validID = $statementID->fetchAll(PDO::FETCH_ASSOC);

    // check if all the boxes are filled

    if (!$user_id || !$university || !$firstname || !$lastname || !$email || !$password || !$dept) {

        $errors[] = 'Please fill in all the room';
    }

    if (!empty($validID)) {
        $errors[] = 'This ID is already taken.';
    } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $errors[] = 'Password should be at least 8 characters in length and should include 
             at least one upper case letter, one number, and one special character.';
    }



    if (empty($errors)) {
        $statement2 = $conn->prepare("INSERT INTO 
            teacher_user(user_id,password)
            VALUES
            (:id,:pass)");
        $statement2->bindValue(':id', $user_id);
        $statement2->bindValue(':pass', $password);
        $statement2->execute();

        $statement = $conn->prepare("INSERT INTO faculty(firstname,lastname,university_name,faculty_id,user_id,email,dept,gender) 
                    VALUES 
                    (:firstname,:lastname,:university,:faculty_id,:user_id,:email,:dept,:gender)");

        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':faculty_id', $user_id);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':dept', $dept);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':university', $university);
        $statement->execute();



        //go back to login page
        header("Location:../login/login_faculty.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up </title>

</head>
<div class="container-img">
    <img src="../assets/images/photo2.png" alt="">
</div>

<div class='container border border-primary'>

    <form class="row g-3" action="signup_faculty.php" method="POST">
        <div class="col-md-6">
            <label for="inputFirstname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="inputFirstname">
        </div>
        <div class="col-md-6">
            <label for="inputLastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="inputLastname">
        </div>
        <div class="col-12">
            <label for="inputusername" class="form-label">User ID</label>
            <input type="text" class="form-control" name="inputUserID" placeholder="Please enter your faculty ID No">
        </div>
        <div class="col-12">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" name="inputEmail">
        </div>
        <div class="col-12">
            <label for="inputEmail4" class="form-label">Password</label>
            <input type="password" class="form-control" name="inputPassword">
        </div>


        <div class="">
            <label for="inputUniversity" class="form-label">University</label>
            <select name="inputUniversity" class="form-select">
                <option selected value="">Select</option>
                <?php foreach ($universities as $university) : ?>
                    <option><?php echo $university['name'] ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <br>

        <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" name="inputCity">
        </div>

        <div class="col-md-4">
            <label for="inputDept" class="form-label">Dept</label>
            <select name="inputDept" class="form-select inputDept">
                <option selected>Select</option>
                <option>CSE</option>
                <option>BBA</option>
                <option>EEE</option>
                <option>BSE</option>
                <option>CE</option>
                <option>AIS</option>
                <option>BSSEDS</option>
                <option>SE</option>
            </select>
        </div>
        <div class="dropdown ">
            <label for="" class="form-label">Gender</label><br>
            <select name="gender" class="form-select">
                <option selected>Select</option>
                <option value="">Male</option>
                <option value="">Female</option>
                <option value="">Other</option>
            </select>
        </div>

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <div><?php echo $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="btn-group">
            <input type="submit" class="btn btn-primary" value="Create New Account">
        </div>
    </form>
    <p class="link">Have an account? <a href="../login/login_faculty.php">Sign In</a></p>
</div>

<?php



?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>