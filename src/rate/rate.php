<?php 
//print_r($_POST);
session_start();
$username=$_SESSION['username'];
$user_id=$_GET['id'];



    require_once "../data/database.php";
    //echo $user_id;

    $errors=[];



    $statement = $conn->prepare('SELECT * FROM faculty WHERE user_id= :faculty_id');
    $statement->bindValue(':faculty_id', $username);
    $statement->execute();
    $faculty = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($faculty as $f){
      $rating=$f['rating'];
      $user_id=$f['user_id'];
    }
  

 
    if ($_SERVER["REQUEST_METHOD"]==="POST"){

        $userid=$_POST['id'];
        $way=$_POST['Inputway'];
        $time=$_POST['Inputtime'];
        $fair=$_POST['Inputfair'];
        $topic=$_POST['Inputtopic'];
        $script=$_POST['Inputscript'];

        $rating= ($way+$time+$fair+$topic+$script)/5;

        //echo $userid;
        echo $rating;
        
        if(empty($errors)){
            
            $statement1=$conn->prepare("UPDATE faculty
                                SET rating =:rating
                                WHERE user_id=:user_id");
                                

                
            $statement1->bindValue(':rating',$rating);
            $statement1->bindValue(':user_id',$userid);
        
            
            $statement1->execute();

        //    header('Location:../search/visit_Profile/facultyVisit.php');
        }
        

    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="rate.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Rate</div>
    <div class="content">
      <form action="rate.php" method="<?php $_SERVER['REQUEST_METHOD']?>" name="id">
       <input type="text" hidden value="<?php echo $user_id ?>" name="id">
        <div class="gender-details">
          <input type="radio" name="Inputway" value="5" id="dot-1">
          <input type="radio" name="Inputway" value="3" id="dot-2">
          <input type="radio" name="Inputway" value="1" id="dot-3"><br>
          <br>
          <span class="gender-title">1. The Faculty's Teaching way was very helpful.</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="Inputway">Agree</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="Inputway">None</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="Inputway">Disagree</span>
            </label>
          </div>
        </div>

        <div class="gender-details">
          <input type="radio" name="Inputtime" value="5" id="dot-4">
          <input type="radio" name="Inputtime" value="3" id="dot-5">
          <input type="radio" name="Inputtime" value="1" id="dot-6">
          <br>
          <span class="gender-title">2. The Faculty was on Time Regularly.</span>
          <div class="category">
            <label for="dot-4">
            <span class="dot four"></span>
            <span class="Inputtime">Agree</span>
          </label>
          <label for="dot-5">
            <span class="dot five"></span>
            <span class="Inputtime">None</span>
          </label>
          <label for="dot-6">
            <span class="dot six"></span>
            <span class="Inputtime">Disagree</span>
            </label>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="Inputfair" value="5" id="dot-7">
          <input type="radio" name="Inputfair" value="3" id="dot-8">
          <input type="radio" name="Inputfair" value="1" id="dot-9">
          <br>
          <span class="gender-title">3. The Faculty was fair to all the students.</span>
          <div class="category">
            <label for="dot-7">
            <span class="dot seven"></span>
            <span class="Inputfair">Agree</span>
          </label>
          <label for="dot-8">
            <span class="dot eight"></span>
            <span class="Inputfair">None</span>
          </label>
          <label for="dot-9">
            <span class="dot nine"></span>
            <span class="Inputfair">Disagree</span>
            </label>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="Inputtopic" value="5" id="dot-10">
          <input type="radio" name="Inputtopic" value="3" id="dot-11">
          <input type="radio" name="Inputtopic" value="1" id="dot-12">
          <br>
          <span class="gender-title">4. The Faculty Covered all the topics on time & properly.</span>
          <div class="category">
            <label for="dot-10">
            <span class="dot ten"></span>
            <span class="Inputtopic">Agree</span>
          </label>
          <label for="dot-11">
            <span class="dot eleven"></span>
            <span class="Inputtopic">None</span>
          </label>
          <label for="dot-12">
            <span class="dot twelve"></span>
            <span class="Inputtopic">Disagree</span>
            </label>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="Inputscript" value="5" id="dot-13">
          <input type="radio" name="Inputscript" value="3" id="dot-14">
          <input type="radio" name="Inputscript" value="1" id="dot-15">
          <br>
          <span class="gender-title">5. The Faculty showed the Answer scripts on time.</span>
          <div class="category">
            <label for="dot-13">
            <span class="dot thirteen"></span>
            <span class="Inputscript">Agree</span>
          </label>
          <label for="dot-14">
            <span class="dot fourteen"></span>
            <span class="Inputscript">None</span>
          </label>
          <label for="dot-15">
            <span class="dot fifteen"></span>
            <span class="Inputscript">Disagree</span>
            </label>
          </div>
        </div>


        <br><br>
       
        <div class="button">
        <form method="post" action="/post">
        <input type="submit" value="Done">
    </form>
          
        </div>

      </form>
    </div>
  </div>

</body>
</html>
