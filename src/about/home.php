<?php
session_start();


unset($_SESSION['username']);
unset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unihub</title>
</head>

<body>
  <div>
    <link href="./home.css" rel="stylesheet" />
    <div>
      <div class="home-home">
        <div class="home-frame4">
          <div class="home-frame41">
            <div class="home-frame42">
              <span class="home-text"><span>University Platform</span></span>
              <div class="home-frame5">
                <span class="home-text02">
                  <span>Connecting All University Elements In One Place.</span>
                </span>
              </div>
            </div>
            <div class="home-frame7"></div>
          </div>
        </div>
        <div class="home-frame8">
          <div class="home-frame51">
            <span class="home-text04"><span> <b> UniHub</b></span></span>

            <div class="home-frame9">
              <span class="home-text06"><a href="about.php" style="text-decoration: none; color:black">About</a></span>

            </div>

            <div class="home-frame3">
              <span class="home-text08"><a href="contact.php" style="text-decoration: none; color:black">Contact</a></span>
            </div>
          </div>
          <div class="home-frame71">
            <span class="home-text08">Sign in as →</span>

            <a class="home-text10" href="../login/login_student.php">Student</a>
            <a class="home-text10" href="../login/login_faculty.php">Faculty</a>

          </div>
        </div>
        <img src="../assets/images/about.jpg" alt="homepage172" class="home-homepage1" />
      </div>
    </div>
  </div>

</body>

</html>