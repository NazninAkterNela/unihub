<?php
session_start();

require_once "../data/database.php";

$username = $_SESSION['username'];
$user = $_SESSION['user'];

require "../navigation/navbar.php";

$per_page = 13;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $per_page;

if (isset($_POST['search'])) {
  $search_text = trim($_POST['search_text']);
  if (!empty($search_text)) {
    try {
      $stmt = $conn->prepare("SELECT `course_id`, `dept_name`, `course_title`, `prerequisite`, `credit` FROM `courses` WHERE `course_id` LIKE CONCAT(:search_text, '%')");
      $stmt->bindValue(':search_text', $search_text, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Calculate total number of pages based on all search results
      $total_count = count($result);
      $pages = ceil($total_count / $per_page);

      // Filter the rows to display only those that belong to the current page
      $result = array_slice($result, ($page - 1) * $per_page, $per_page);
    } catch (PDOException $e) {
    }
  } else {
    try {
      $stmt = $conn->prepare("SELECT `course_id`, `dept_name`, `course_title`, `prerequisite`, `credit` FROM `courses` LIMIT :start, :per_page;");
      $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
      $stmt->bindValue(':start', $start, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $total_count = $conn->query("SELECT COUNT(*) FROM `courses`")->fetchColumn();
      $pages = ceil($total_count / $per_page);
    } catch (PDOException $e) {
    }
  }
} else {
  try {
    $stmt = $conn->prepare("SELECT `course_id`, `dept_name`, `course_title`, `prerequisite`, `credit` FROM `courses` LIMIT :start, :per_page;");
    $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_count = $conn->query("SELECT COUNT(*) FROM `courses`")->fetchColumn();
    $pages = ceil($total_count / $per_page);
  } catch (PDOException $e) {
  }
}

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
  <title>Courses List</title>
</head>

<body>

  <div class="container">
    <h2 class="text-center mb-3">List of Available Courses</h2>
    <form method="POST" action="">
      <div class="row mb-3">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by course name" name="search_text" onkeyup="searchCourses(this.value)" value="<?php if (isset($search_text)) {
                                                                                                                                                        echo $search_text;
                                                                                                                                                      } ?>">
            <button class="btn btn-outline-secondary" type="submit" name="search"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
    </form>

    <?php if (count($result) > 0) : ?>

      <style>
        /* Style the button */
        button {
          background-color: #fff;
          color: black;

          border: none;



        }

      /* Remove the button's border on hover */
      button:hover {
        border: none;
        border-bottom: 3px solid #08e287;
      }
    </style>
    <table id="coursesTable">
      <thead>
        <tr>
          <th>Course Code</th>
          <th>Department</th>
          <th>Course Title</th>
          <th>Prerequisite</th>
          <th>Credit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $row): ?>
          <tr>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['dept_name']; ?></td>
            <td>
              <form action="../online-lectures/lectures.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['course_id']; ?>">
                <input type="hidden" name="name" value="<?php echo $row['course_title']; ?>">
                <button type="submit" ><?php echo $row['course_title']; ?></button>
              </form>
            </td>
            <td><?php echo $row['prerequisite']; ?></td>
            <td><?php echo $row['credit']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


      <?php if (isset($pages)) : ?>
        <div class="pagination">
          <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <a href="?page=<?php echo $i; ?><?php if (isset($search_text)) {
                                              echo '&search_text=' . $search_text;
                                            } ?>" <?php if ($page === $i) : ?>class="active" <?php endif; ?>><?php echo $i; ?></a>
          <?php endfor; ?>
        </div>
      <?php endif; ?>

    <?php else : ?>
      <p>No courses found.</p>
    <?php endif; ?>
  </div>

  <script src="../navigation/navbar.js"></script>
  <script src="script.js"></script>
  <script>
    function searchCourses(searchText) {
      var coursesTable = document.getElementById("coursesTable");
      var rows = coursesTable.getElementsByTagName("tr");
      for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var matchFound = false;
        for (var j = 0; j < cells.length; j++) {
          if (cells[j].innerHTML.toLowerCase().includes(searchText.toLowerCase())) {
            matchFound = true;
            break;
          }
        }
        if (matchFound) {
          rows[i].style.display = "";
        } else {
          rows[i].style.display = "none";
        }
      }
    }
  </script>
</body>

</html>