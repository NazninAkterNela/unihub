<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../login/404.php");
  exit();
}

require_once "../data/database.php";

$username = $_SESSION['username'];
$user = $_SESSION['user'];

// SQL query to fetch students available for hire
$sql = "SELECT * FROM student WHERE RA = 'Yes' OR TA = 'Yes' OR home_tutor = 'Yes'";

// Execute the query
$stmt = $conn->query($sql);

require "../navigation/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/icons/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link rel="stylesheet" href="../navigation/navbar.css">
  <link rel="stylesheet" href="style.css">
  <title>Hire</title>
</head>

<body>


  <section class="container my-5">
    <h2 class="text-center mb-4">Available For Hire</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Dept</th>
              <th>RA</th>
              <th>TA</th>
              <th>Home Tutor</th>
              <th>Profile</th>
              <th>Hire</th>
            </tr>
          </thead>
          <tbody>

            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['contact_number']; ?></td>
                <td><?php echo $row['dept']; ?></td>
                <td><?php echo ($row['RA'] == 'yes') ? 'Available' : 'Not Available'; ?></td>
                <td><?php echo ($row['TA'] == 'yes') ? 'Available' : 'Not Available'; ?></td>
                <td><?php echo ($row['home_tutor'] == 'yes') ? 'Available' : 'Not Available'; ?></td>
                <td><a href="../visit_Profile/studentVisit.php?userProfile=<?php echo $row['student_id']; ?>" class="btn btn-primary"><i class="fas fa-user"></i> View</a></td>
                <td><a href="#" class="btn btn-success"><i class="fas fa-user-check"></i> Hire</a></td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../navigation/navbar.js"></script>
</body>

</html>