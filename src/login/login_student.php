<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel = "icon" href ="../assets/icons/logo.png" type = "image/x-icon">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <h1>Please Login </h1>
        <form action="../data/data_S.php" method="post">
            <div class="form-control">
                <input type="text" name="id" required>
                <label for="">Your ID</label>
            </div>
            <div class="form-control">
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <button class="btn">Login</button>
            <p>Don't have an account? <a href="../signup/signup_student.php">Register Here</a></p>
        </form>
        <p>Forgot password?<a href="../password-reset/reset-student/forgot-password-student.php"> click here</a></p>
    </div>


    <script src="login.js"></script>
</body>
</html>