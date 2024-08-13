<?php 
session_start();
$originalUser=$_SESSION['username'];
$userid=$_GET['userProfile'];
$user=$_SESSION['user'];
require_once "../data/student_data.php";



if(isset($_GET['form2'])){
    $statement=$conn->prepare('INSERT INTO 
                                follower(username,follower)
                                VALUES
                                (:username,:follower)');
    $statement->bindValue(':username',$userid);
    $statement->bindValue(':follower',$originalUser);
    $statement->execute();
}
elseif(isset($_GET['form1'])){
    $statement=$conn->prepare('DELETE FROM 
                                follower
                                WHERE
                                username=:username AND follower=:follower');
    $statement->bindValue(':username',$userid);
    $statement->bindValue(':follower',$originalUser);
    $statement->execute();
}

$following= false;

$statement=$conn->prepare('SELECT *
                            FROM follower f
                            WHERE f.username=:username AND f.follower=:follower');
$statement->bindValue(':username',$userid);
$statement->bindValue(':follower',$originalUser);
$statement->execute();
$result=$statement->fetchAll(PDO::FETCH_ASSOC);

if(!empty($result)){
    $following=true;
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../profile/style.css">
    <link rel="stylesheet" href="../navigation/navbar.css">
    <link rel="stylesheet" href="profile/navbar.css">
</head>
<body>
    

     <?php include "../navigation/navbar.php"?>

    <section class="container-profile">
        <section class="profile">
            <div class="container-photo">
                <img src="../assets/images/dp-1.jpg" class="img-dp img-thumbnail rounded mx-auto d-block"alt="">
                <a href="#"><i class='far fa-edit' style='font-size:24px'></i></a>
                
            </div>
            <div class="container-details">
                <div class="div1">
                    <h1><?php echo $firstname." ".$lastname  ?></h1>
                    <h2>Studies at <span style="font-weight:600"><?php echo $university  ?></span></h2>
                    <h2><?php echo $city  ?></h2>
                </div>

                <div>
                    <?php if($following==true): ?>
                        <form action="" method="GET">
                            <input type="text" hidden name="userProfile" value=<?php echo $userid ?>>
                             <button type="submit" name="form1" class="" role="button">Unfollow</button>
                        </form>

                    <?php else: ?>
                        <form action="">
                            <input type="text" hidden name="userProfile" value=<?php echo $userid ?>>
                            <button type="submit" name="form2" class="" role="button">Follow</button>
                        </form>

                    <?php endif; ?>
                </div>
                
            </div>
        </section>
        
        <section class="profile about">
            <div class="div1">
                <h1>Bio</h1>
            
            </div>
            <div id="about-edit" class="edit">
                <div class="">
                    <h2>Email: </h2>
                    <input type="text"  readonly value=<?php echo $email ?>>
                </div>
                <div>
                    <h2>Contact: </h2>
                    <input type="text" class="about-edit" placeholder="Not Provided" readonly value=<?php echo $contact_number ?>>
                </div>
                <div>
                    <h2>Date of birth: </h2>
                    <input type="text" class="" placeholder="Not Provided" readonly value=<?php echo $date_of_birth ?>>
                </div>
                <div>
                    <h2>City: </h2>
                    <input type="text" placeholder="Not Provided" class="about-edit" readonly value=<?php echo $city ?>>
                </div>
                <div>
                    <h2>Gender: </h2>
                    <input type="text" placeholder="Not Provided" class="" readonly value=<?php echo $gender ?>>
                </div>    
            </div>
        </section>
    </section>



    <section class="details">
        <form action="" method="post" name="form1" >
            <div class="div1">
                <h1>Details</h1>
                <label  hidden name="id"><?php echo $student_id ?></label>
                
            </div>
            <div id="details-edit" class="edit">
                <div class="">
                    <h2>Department: </h2>
                    <input type="text"  readonly value=<?php echo $dept ?>>
                </div>
                <div>
                    <h2>Cgpa: </h2>
                    <input type="text" id="inputCgpa" name="inputCgpa" class="details-edit" placeholder="Not Provided"  value=<?php echo $cgpa ?> >
                </div>
                <div>
                    <h2>Semester: </h2>
                    <input type="text" id="inputCgpa" name="inputSemester" class="details-edit" placeholder="Not Provided" value=<?php echo $semester ?> >
                </div>
                <div>
                    <h2>Credit Completed: </h2>
                    <input type="text" id="inputCgpa" name="inputCC" class="details-edit" placeholder="Not Provided" value=<?php echo $cc ?> >
                </div>     
            </div>
        </form>      
    </section>

    <section class="container-running">
        <div class="div1">
            <h1>Running Courses</h1>
        </div>
        
        <div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($student3 as $course): ?>
                    <tr>
                    <th scope="row"><?php echo $course['course_id'] ?></th>
                    <td><?php echo $course['course_title'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>       
            </table>
        </div>
    </section>



    <section class="footer">
                <!-- Footer -->
        <footer class="text-center text-lg-start text-muted">
        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="fw-bold mb-4">
                    <i class="fas fa-gem me-3 text-secondary"></i>UniHub
                </h6>
                <p>
                    Find your classmates, <br>
                    Find your teacher <br> 
                    Connect with your university.
                </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                    Connect 
                </h6>
                <p>
                    <a href="#!" class="text-reset">Facebook</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Instagram</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Twitter</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Linkedin</a>
                </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                    Useful links
                </h6>
                <p>
                    <a href="#!" class="text-reset">About Us</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Settings</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Help</a>
                </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p>
                    <i class="fas fa-envelope me-3 text-secondary"></i>
                    unihub@gmail.com
                </p>
                <p><i class="fas fa-phone me-3 text-secondary"></i> +880 195 756 0591</p>
                <p><i class="fas fa-phone me-3 text-secondary"></i> +880 197 023 5455 </p>
                <p><i class="fas fa-phone me-3 text-secondary"></i> +880 175 035 0060</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">UniHub.com</a>
        </div>
        <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </section>

    


    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <script src="profile.js"></script>
    <script src="https://kit.fontawesome.com/dba87631dd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../navigation/navbar.js"></script>
</body>
</html>