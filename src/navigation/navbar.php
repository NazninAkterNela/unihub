<?php

session_start();
$username=$_SESSION['username'];
$user=$_SESSION['user'];
$_SESSION['username']=$username;
$_SESSION['user']=$user;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <!--Main Navigation-->
<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="#" class="list-group-item list-group-item-action py-2 ripple"
                   id="profile" aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                    <span>Profile</span>
                    <span class="user-type" hidden><?php echo $user ?></span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple " id="home">
                    <i class="fas fa-chart-area fa-fw me-3"></i>
                    <span>Home</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" id="search">
                    <i class="fas fa-chart-line fa-fw me-3"></i>
                    <span>Search</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" id="market">
                    <i class="fas fa-globe fa-fw me-3"></i>
                    <span>Market</span>
                </a>
                <?php if($user != "student"){ ?>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple" id="hire">
                        <i class="fas fa-building fa-fw me-3"></i>
                        <span>Hire</span>
                    </a>
                <?php } ?>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" id="course-list">
                    <i class="fas fa-building fa-fw me-3"></i>
                    <span>Course-list</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="../assets/icons/logo.png" height="50" alt="" loading="lazy"/>
            </a>
            <!-- Search form -->
            <nav class="navbar navbar-profile ">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-list-4">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               role="button" data-toggle="dropdown" aria-expanded="false">
                                <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg"
                                     width="40" height="40" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#" id="anchor" value="<?php echo $user ?>"> <?php echo $user ?></a>
                                <a class="dropdown-item" href="#">Edit Profile</a>
                                <a class="dropdown-item" href="../about/home.php">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>



        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
  <!--Main Navigation-->
  
  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
  
    </div>
  </main>
  <!--Main layout-->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="navbar.js"></script>
</body>
</html>