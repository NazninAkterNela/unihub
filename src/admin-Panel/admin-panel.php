<?php

session_start();
$username=$_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>User List</h1>

    <?php
    // Establish a database connection using PDO
    require_once "../data/database.php";

    // Fetch user data from the database
    $sql = 'SELECT * FROM logger';
    $stmt = $conn->query($sql);

    // Display user data in an HTML table
    echo '<table>';
    echo '<tr><th>username</th><th>time</th><th>block user</th></tr>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '<td>';
        echo '<form action="block.php" method="post">';
        echo '<button type="submit">block</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';

    // Close the database connection
    $pdo = null;
    ?>

</body>
</html>

