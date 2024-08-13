<?php
    /** @var $pdo \PDO */
    require_once "../data/database.php";
    $homeTutor = '';

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(isset($_POST['submit']))
        {
            $ht = $conn->prepare('SELECT*
                                  FROM student s
                                  WHERE home_tutor = 1');
            $ht->execute();
            $homeTutor = $ht->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../jobs/homeTutorLists.css">
    <link rel="stylesheet" href="../search/visit_Profile/navbar.css">
    <title>Home Tutors</title>
</head>
<body>
    <section class="navbar">
        <?php include '../profile//navbar_S.php'; ?>
    </section>

    <section class ="Result">
        <div class="container">
            <h2 class="text-center">All Home Tutors</h2>
            <?php if(empty($homeTutor)): ?>
                <h2 class="text-center">No Home tutors found yet</h2>
            <?php endif; ?>

            <?php if(is_array($homeTutor) || is_object($homeTutor)): ?>
            <?php foreach($homeTutor as $items): ?>
            <div class="resultss">
                <div class="result-img">
                <img src="../assets/images/abrar.jpg" class="img-responsive">
                </div>
                <div class =result-desc>
                    <h4><?php echo $items['firstname']. " " . $items['lastname'] ?></h4>
                    <a href="mailto: <?php echo $items['email']; ?>"><h1>Send Email</h1></a>
                    <p class="result-cgpa"> <?php echo "CGPA: ". $items['cgpa']; ?></p>
                    <p class="result-cgpa"> <?php echo "Contact: ". $items['contact_number']; ?></p>
                    <p class="result-cgpa"> <?php echo "University Name: ". $items['university_name']; ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php endforeach; ?> <!---- Here loops ends ---->
            <?php endif; ?>      

        <div class="clearfix"></div>
        </div>
    </section>

    <section class="footer">
        <div id ="footer" class="container text-center">
            <p>UniHub is a platform where you get every information related to any unversity.
                 For more <a href="">Click Here</a>
            </p>
            
        </div> 
    </section>
</body>
</html>