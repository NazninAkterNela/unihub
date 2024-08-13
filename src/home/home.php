<?php 
session_start();
require_once "../data/database.php";
$username=$_SESSION['username'];
$user=$_SESSION['user'];


if($user=='student'){
    $statement2=$conn->prepare('SELECT *
                            FROM student 
                            WHERE user_id=:userid');
    $statement2->bindValue(':userid',$username);
    $statement2->execute();
    $student2=$statement2->fetchAll(PDO::FETCH_ASSOC);
    foreach($student2 as $s){
        $student_id=$s['student_id'];
        $firstname=$s['firstname'];
        $lastname=$s['lastname'];
        $email=$s['email'];
        $contact_number=$s['contact_number'];
        $university=$s['university_name'];
    }
}
if($user=='faculty'){
    $statement2=$conn->prepare('SELECT *
                            FROM faculty 
                            WHERE user_id=:userid');
    $statement2->bindValue(':userid',$username);
    $statement2->execute();
    $student2=$statement2->fetchAll(PDO::FETCH_ASSOC);
    foreach($student2 as $s){
        $student_id=$s['faculty_id'];
        $firstname=$s['firstname'];
        $lastname=$s['lastname'];
        $email=$s['email'];
        $contact_number=$s['contact_number'];
        $university=$s['university_name'];
    }
}

if(isset($_POST['form1'])){
    $message=$_POST['post-container'];
    $statement=$conn->prepare('INSERT INTO
                                forum(creator_id,content,creator_name)
                                VALUES(:creator_id,:content,:creator_name)');
    $statement->bindValue(':creator_id',$username);
    $statement->bindValue(':content',$message);
    $creator_name=$firstname." ".$lastname;
    $statement->bindValue(':creator_name',$creator_name);
    $statement->execute();
}

$statement3=$conn->prepare('SELECT *
                            FROM forum
                            WHERE creator_id=:userid');
$statement3->bindValue(':userid',$username);
$statement3->execute();
$posts=$statement3->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['form2'])){
    echo "inside form 1";
    $comment=$_POST['comment-container'];
    $forum_id=$_POST['forum-no'];
    $commentor_name=$_POST['commentor-name'];
    $commentor_id=$_POST['commentor-id'];
    $statement4=$conn->prepare('INSERT INTO 
                                comments(forum_id,comment,commentor_name,commentor_id)
                                VALUES
                                (:forum_id,:comment,:commentor_name,:commentor_id)');
    $statement4->bindValue(':forum_id',$forum_id);
    $statement4->bindValue(':comment',$comment);
    $statement4->bindValue(':commentor_name',$commentor_name);
    $statement4->bindValue(':commentor_id',$commentor_id);
    $statement4->execute();
    $posts=$statement4->fetchAll(PDO::FETCH_ASSOC);
}



//getting user's following list
$statement6=$conn->prepare('SELECT *
                            FROM follower f
                            WHERE f.follower=:follower');

$statement6->bindValue(':follower',$username);
$statement6->execute();
$list=$statement6->fetchAll(PDO::FETCH_ASSOC);


$totalforums=[];
foreach($list as $following){
    $creator_id=$following['username'];
    $statement7=$conn->prepare('SELECT *
                                FROM forum
                                WHERE creator_id=:creator_id');
    $statement7->bindValue(':creator_id',$creator_id);
    $statement7->execute();
    $list2=$statement7->fetchAll(PDO::FETCH_ASSOC);
    foreach($list2 as $forum){
        array_push($totalforums,$forum);
    }
    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel = "icon" href ="../assets/icons/logo.png" type = "image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../navigation/navbar.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php
        include "../navigation/navbar.php";
    ?>

    <section class="">
        <!-- new post -->
        <form action="" method="POST" name="form1">
            <div class="write-post-container">
                <div class="user-profile">
                    <img src="../assets/images/dp-1.jpg" alt="">
                    <div>
                        <p><?php echo $firstname." ".$lastname ?></p>
                        <small>Public <i class="fa-sharp fa-solid fa-caret-down"></i></small>
                    </div>
                </div>

                <div class="post-input-container">
                    <textarea name="post-container" rows="3" placeholder="What's on your mind?"></textarea>
                </div>
                <div class="post-button">
                    <input type="submit" name="form1" class="btn btn-warning"  value="post">
                </div>

            </div>
        </form>
    
        
    </section>


    <div class="vertical-line"></div>
    <div class="horizontal-line"></div>
    <h1 class='your-post-h1'>Your Posts</h1>

    <!-- personal posts -->
    <section class="personal-post-container">
        
            <?php foreach($posts as $post): ?>
            <?php $var=$post['forum_id'];
            $statement5=$conn->prepare('SELECT *
                                        FROM comments
                                        WHERE forum_id=:userid');
            $statement5->bindValue(':userid',$var);
            $statement5->execute();
            $comments=$statement5->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="written-post-container">
                <div class="user-profile">
                    <img src="../assets/images/dp-1.jpg" alt="">
                    <div>
                        <p><?php echo $firstname." ".$lastname ?></p>
                        <p><?php echo $post['content']?></p>
                    </div>
                </div>
                <hr>
                <form action="" name="form2" method="POST">
                    <div class="user-profile2">
                        <img src="../assets/images/dp-1.jpg" alt="">
                        <div class="comment comment-new">
                            <div>
                                <input class="input-name" name="commentor-name" value="<?php echo $firstname." ".$lastname ?>">
                                <input type="" hidden name="commentor-id" value="<?php echo $userid ?>">
                                <textarea name="comment-container"  placeholder="Reply"></textarea>
                                <input type="text" name="forum-no" hidden value="<?php echo $post['forum_id']?>">
                            </div>
                            
                            <div>
                                <input type="submit" name="form2" class="btn btn-warning btn-comment"  value="post">
                            </div>
                        </div>

                    </div>
                </form>
                <?php
                ?>

                <?php foreach($comments as $comment): ?>

                    <div class="user-profile2">
                        <img src="../assets/images/dp-1.jpg" alt="">
                        <div class="comment">
                            <p><?php echo $comment['commentor_name']?></p>
                      
                            <textarea name="comment-container" readonly rows="2"><?php echo $comment['comment']?></textarea>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>

        <?php endforeach; ?>
        
    </section>


    <!-- followers post -->
    <?php foreach($totalforums as $forum): ?>

        <?php 
       
        ?>

        <section class="followers-post">
        <form action="" method="POST" name="form1">
            <div class="write-post-container">
                <div class="user-profile">
                    <img src="../assets/images/dp-1.jpg" alt="">
                    <div class=>
                        <p><?php echo $forum['creator_name']?></p>
                        <textarea name="comment-container" readonly ><?php echo $forum['content']?></textarea>
                    </div>
                </div>
                <hr>
                <form action="" name="form2" method="POST">
                    <div class="user-profile3">
                        <img src="../assets/images/dp-1.jpg" alt="">
                        <div class="comment comment-new">
                            <div class="comment">
                                <input class="input-name" name="commentor-name" value="<?php echo $firstname." ".$lastname ?>">
                                <input type="" hidden name="commentor-id" value="<?php echo $username ?>">
                                <textarea name="comment-container"  placeholder="Reply"></textarea>
                                <input type="text" name="forum-no" hidden value="<?php echo $post['forum_id']?>">
                            </div>
                            
                            <div>
                                <input type="submit" name="form2" class="btn btn-warning btn-comment"  value="post">
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </form>
        </section>
    <?php endforeach; ?>
    

   
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../navigation/navbar.js"></script>
    
</body>
</html>