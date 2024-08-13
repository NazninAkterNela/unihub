<?php
    /** @var $pdo \PDO */
    require_once "../data/database.php";

    $student2 ='';
    $subject = '';

    if($_SERVER['REQUEST_METHOD']==="POST")
    {
        if(isset($_POST['submit']))
        {
            $subject = $_POST['search'];
            $st = $conn->prepare('SELECT *
                                FROM home_tutor e
                                WHERE e.student_id IN (SELECT b.student_id
                                                      FROM home_tutor_subject b
                                                      WHERE b.subject= :subjects)');
            $st->bindValue(':subjects', $subject);
            $st->execute();
            $student2 = $st->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    $facultyTA = $conn->prepare('SELECT*
                                FROM faculty e
                                WHERE e.TA_needed=1');
    $facultyTA->execute();
    $TA = $facultyTA->fetchAll(PDO:: FETCH_ASSOC);

    $hT = $conn->prepare('SELECT*
                        FROM student s
                        WHERE s.home_tutor=1');
    
    $hT->execute();
    $sTT = $hT->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jobss.css">
    <link rel="stylesheet" href="../search/visit_Profile/navbar.css">
    <title>Job Finder</title>
</head>
<body>
    <section class="navbar">
        <?php include '../profile//navbar_S.php'; ?>
        <!-- include nav.php here -->
        <!-- <div class="container">


            </div> -->
    </section>

    <section class="search text-center">
        <!-- include search box -->
        <div class="container">
            <form action="../jobs/jobs.php" method="post">
                <input type="search" name="search" placeholder="Find HomeTutors by Subject">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">


            </form>

        </div>
    </section>

    <section class="categories">
        <!-- 3 types of jobs here -->
        <div class="container">
            <h2 class="text-center">Job types</h2>
            <a href="#">
            <div class="box-3 float-container">
                <img src="../assets/images/HomeTutor.png" alt="Home Tutor" class="img-responsive">
                <form action="../jobs/homeTutorList.php" method="post">
                <input type="submit" name="submit" value="Home Tutors" class="float-text text-purple">


                </form>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="../assets/images/RA.png" alt="RA" class="img-responsive">
                
                <button type="submit" class="float-text text-purple" onclick="openPopup()">Research Assistant</button>
                <div class="popup" id="popup">
                    <h2>Here are the list</h2>
                    <?php if(empty($TA)): ?>
                    <h2 class="text-center">No TA needed</h2>
                     <?php endif; ?>

                    <?php if(is_array($TA) || is_object($TA)): ?>
                    <?php foreach($TA as $items): ?>
                        <div class="resultss">
                        <div class="result-img">
                            <img src="../assets/images/abrar.jpg" class="img-responsive">
                        </div>
                        <div class="result-desc">
                            <h4><?php echo $items['firstname']; ?></h4>
                            <p class="result-phoneNumber"><?php echo $items['lastname']; ?></p>
                            <a href="mailto: <?php echo $items['email']; ?>"><h1>Send Email</h1></a>
                        </div>          
                        <div class="clearfix"></div>
        
                        </div>
                        <?php endforeach; ?> <!---- Here loops ends ---->
                         <?php endif; ?>
                <button type="button" onclick="closePopup()">Close</button>
                </div>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="../assets/images/TA.png" alt="TA" class="img-responsive">
                <button type="submit" class="float-text text-purple" onclick="openPopup()">Teacher's Assistant</button>
                <div class="popup" id="popup">
                    <h2>Here are the list</h2>
                    <?php if(empty($TA)): ?>
                    <h2 class="text-center">No TA needed</h2>
                     <?php endif; ?>

                    <?php if(is_array($TA) || is_object($TA)): ?>
                    <?php foreach($TA as $items): ?>
                        <div class="resultss">
                        <div class="result-img">
                            <img src="../assets/images/abrar.jpg" class="img-responsive">
                        </div>
                        <div class="result-desc">
                            <h4><?php echo $items['firstname']; ?></h4>
                            <p class="result-phoneNumber"><?php echo $items['lastname']; ?></p>
                            <a href="mailto: <?php echo $items['email']; ?>"><h1>Send Email</h1></a>
                        </div>          
                        <div class="clearfix"></div>
        
                        </div>
                        <?php endforeach; ?> <!---- Here loops ends ---->
                         <?php endif; ?>
                <button type="button" onclick="closePopup()">Close</button>
                </div>
            </div>
            </a>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="result">
        <div class="container">
            <h2 class="text-center">The Following Result</h2>
            
            <?php if(empty($student2)): ?>
                <h2 class="text-center">No Home tutors found yet</h2>
            <?php endif; ?>

            <?php if(is_array($student2) || is_object($student2)): ?>
            <?php foreach($student2 as $items): ?>
                <div class="resultss">
                <div class="result-img">
                    <img src="../assets/images/abrar.jpg" class="img-responsive">
                </div>

                
                <div class="result-desc">
                    <h4><?php echo $items['name']; ?></h4>
                    <p class="result-phoneNumber"><?php echo "Contact#: ". $items['contact_number']; ?></p>
                    <p class="result-studentID"><?php echo"Subject: ". $subject ?></p>
                </div>          
                <div class="clearfix"></div>
                
                </div>
            <?php endforeach; ?> <!---- Here loops ends ---->

            <?php endif; ?>


            <div class="clearfix"></div>
        </div>
    </section>

    <section class="footer">
        <div class="container text-center">
            <p>UniHub is a platform where you get every information related to any unversity.
                 For more <a href="">Click Here</a>
            </p>
        </div> 
    </section>


    <script> 
      let popup = document.getElementById("popup");
        function openPopup(){
         popup.classList.add("open-popup");
         }
         function closePopup(){
         popup.classList.remove("open-popup");
        }
    </script>

</body>
</html>