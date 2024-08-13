<?php
        // $pdo = new PDO('mysql:host=localhost; port=3306; dbname=markettest', 'root', '');
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        require_once "../data/database.php";

        $statement = $conn->prepare('SELECT * FROM products ORDER BY productid DESC');
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login/404.php");
    exit();
}
$username=$_SESSION['username'];
$user=$_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="market.css">
    <title>Market Place</title>
</head>
<body>
    <section class="search text-center">
        <div class="container">
            <h2 id="ser">Search</h2>
            <form action="">
                <input type="search" name="search" placeholder="Search Item">
                <input type="submt" name ="submit" value="Search" class="btn btn-primary">
                <button class="btn btn-primary"><a href="createPost.php">Post</a></button>
            </form>
            <!-- <a href="createPost.php" id="creating">Create Sell Post</a> -->
        </div>
    </section>
    <!-- <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>
            <div class="box-3 float-container">
                <img src="hardware2.jpg" alt="Image" class="img-responsive">
                <h3 class="float-text">Hardwares</h3>
            </div>
            <div class="box-3">
                <img src="book2.jpg" alt="Image" class="img-responsive">
                <h3 class="float-text">Books</h3>
            </div>
            <div class="clearfix"></div>
        </div>
    </section> -->
    <section class="gallery">
        <div class="container">
            <h2 class="text-center">Explore Items</h2>
            <?php foreach($products as $i=> $product): ?>
            <div class="gallery-box">
                <div class="gallery-img">
                    <img src="<?php echo $product['image']?>" alt="Image" class="img-responsive img-curve">
                </div>
                <div class="gallery-desc">
                    <h4><?php echo $product['title'] ?></h4>
                    <p class="price"> <?php echo $product['price'] ?> </p>
                    <p class="seller"> <?php echo $product['seller'] ?> </p>
                    <p class="seller"> <?php echo $product['contact']?> </p>
                    <br>
                    <a href="mailto: <?php echo $product['email']; ?>" class="btn btn-primary">Send Email</a>
                </div>
                <div class="clearfix">

                </div>
            </div>
            <?php endforeach; ?>
            <div class="clearfix">

            </div>
        </div>
    </section>
</body>
</html>