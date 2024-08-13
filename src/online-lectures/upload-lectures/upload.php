<?php

session_start();


$userid=$_SESSION['username'];
$user=$_SESSION['user'];
$_SESSION["user"] = $user;
$_SESSION["username"] =$userid;

require_once "../../data/database.php";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $courseCode = $_POST["course_code"];
  $courseName = $_POST["course_name"];
  $facultyName = $_POST["lecturer_name"];
  $facultyID = $_POST["lecturer_name"];
  $videoUrl = $_POST["video_url"];
  $videoName = $_POST["video_name"];
  

  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO online_lectures (youtubeId, courseCode, courseName, facultyId,facultyName, videoName) 
                        VALUES (:youtubeId, :courseCode, :courseName, :facultyId, :facultyName, :videoName)");

  // Bind parameters
  $stmt->bindParam(":courseCode", $courseCode);
  $stmt->bindParam(":courseName", $courseName);
  $stmt->bindParam(":facultyName", $facultyName);
  $stmt->bindParam(":facultyId", $facultyID);
  $stmt->bindParam(":youtubeId", $videoUrl);
  $stmt->bindParam(":videoName", $videoName);

  // Execute statement
  try {
    $stmt->execute();
    echo '<script>alert("Course details uploaded successfully!")</script>';
    header('location: ../../profile/profile_faculty.php');
  } catch (PDOException $e) {
    echo "<script>alert(Error uploading course details:)</script>" . $e->getMessage();
    // echo "Error uploading course details: " . $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Video Details</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Upload Course Details</h1>
  <form method="post">
    <label for="description">Video Name:</label><br>
    <input type="text" id="video_name" name="video_name" required><br><br>

    <label for="course_name">Course Code:</label>
    <input type="text" id="course_name" name="course_code" required><br><br>
    <label for="course_name">Course Name:</label>
    <input type="text" id="course_name" name="course_name" required><br><br>
    <label for="lecturer_name">Lecturer Name:</label>
    <input type="text" id="lecturer_name" name="lecturer_name" required><br><br>
    <label for="lecturer_name">Lecturer ID:</label>
    <input type="text" id="lecturer_name" name="lecturer_id" required value=<?php echo $userid ?>><br><br>
    <label for="video_url">Youtube video ID:</label>
    <input type="text" id="video_url" name="video_url" required><br><br>
    
    <input type="submit" value="Upload Course Details">
  </form>
</body>
</html>
