
<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../login/404.php");
  exit();
}

$userid=$_SESSION['username'];
$user=$_SESSION['user'];
$_SESSION["user"] = $user;
$_SESSION["username"] =$userid;


require_once "../data/database.php";

if($_SERVER['REQUEST_METHOD']==="POST"){
  $courseCode=$_POST['id'];
  $courseName=$_POST['name'];


  $statement=$conn->prepare('Select *
                        From online_lectures
                        Where courseCode=:courseCode ORDER BY videoName'
                        );
  $statement->bindValue(':courseCode',$courseCode);
  $statement->execute();
  $videos=$statement->fetchAll(PDO::FETCH_ASSOC);

  if(!empty($videos)){
    foreach($videos as $video){
      $youtubeId=$video['youtubeId'];
      $courseCode=$video['courseCode'];
      $courseName=$video['courseName'];
      $facultyId=$video['facultyId'];
      $facultyName=$video['facultyName'];
      $VideoName=$video['videoName'];
    }
  }
  
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Online Lecture Videos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../navigation/navbar.css">
  </head>
  <body>

    <div class="container">
      <h1><?php echo $courseName ?></h1>

      <div class="search">
        <label for="course-search">Search by Video Name:</label>
        <input type="text" id="course-search" onkeyup="searchLectures()" placeholder="Type a video name...">
      </div>

      <div class="grid">
        <?php foreach($videos as $video): ?>
          <div class="lecture">
              <h2 class="course"><?php echo $video['videoName'] ?></h2>
              <p>By <span class="lecturer"><?php echo $video['facultyName'] ?></span></p>
              <iframe src="https://www.youtube.com/embed/<?php echo $video['youtubeId'] ?>"></iframe>
          </div>
        <?php endforeach; ?>
        
      </div>
      
    </div>
    <script src="script.js"></script>
    
  </body>
</html>
