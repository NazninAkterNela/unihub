<?php
    require_once "../data/database.php";
    //To Generate Random Folder name for Image
    function rndtr($n){ 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for($i=0; $i<$n; $i++){
            $index = rand(0, strlen($characters)-1);
            $str .= $characters[$index];
        }
        return $str;
    }

    // $pdo = new PDO('mysql:host=localhost; port=3306; dbname=markettest', 'root', '');
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $title =  '';
    $name = '';
    $contact = '';
    $email = '';
    $description = '';
    $price = '';
    $used = '';
    $errors = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $title = $_POST['title'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $used = $_POST['used'];

        if(!$title){
            $errors[] = 'Title not yet specifed';
        }
        if(!$price){
            $errors[] = 'Price not yet specified';
        }
        if(!$name){
            $errors[] = 'Name not yet specified';
        }
        if(!$contact){
            $errors[] = 'Contact not yet specified';
        }
        // if(!$email){
        //     $errors[] = 'Email not yet specified';
        // }
        if(!is_dir('images')){
            mkdir('images');
        }

        if(empty($errors)){
            $image = $_FILES['image'];
            $imagePath = '';
            if ($image && $image['tmp_name']) {
                $imagePath = 'images/'.rndtr(8).'/'.$image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            $statement = $conn->prepare("INSERT INTO products(title, seller, contact, email, image, description, price, used)
                    VALUES(:title, :name, :contact, :email, :image, :description, :price, :used)");
            $statement->bindValue(':title', $title);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':contact', $contact);
            $statement->bindValue(':email', $email);
            $statement->bindValue('image', $imagePath);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':used', $used);
            $statement->execute();
            header('Location: market.php');
        }
    }

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
    <link rel="stylesheet" href="createPost.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Sell Product</title>
</head>
<body>
    <section class="box">
        <div class="container">
            <h1>Create Sell Post</h1>
            <?php if(!empty($error)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                    <h2><?php echo $error ?></h2>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Product Image</label>
                <br>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <label>Product Title</label>
                <input type="text" class="form-control" name="title" value ="<?php echo $title ?>">
            </div>
            <div class="form-group">
                <label>Seller Name</label>
                <input type="text" class="form-control" name="name" value ="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" class="form-control" name="contact" value ="<?php echo $contact ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value ="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <label>Product Decription</label>
                <textarea class="form-control" name="description"><?php echo $description ?></textarea>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" step =".01" class="form-control" name="price" value="<?php echo $price ?>">
            </div>
            <div class="form-group">
                <label>Days Used</label>
                <input type="number" step ="1" class="form-control" name="used" value="<?php echo $used ?>">
            </div>
            <button type="submit" class="btn btn-primary" id="bt" name="btn">Submit</button>
            </form>
        </div>

    </section>
</body>
</html>