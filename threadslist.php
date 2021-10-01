<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

    <title>Welcome to iDiscuss</title>
</head>

<body>

    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $catename = $row['category_name'];
        $catedesc = $row['Category_decrpition'];
    }
    ?>



<?php
$showAlert = false;
$method = $_SERVER['REQUEST_METHOD'] ;
if($method =='POST'){
    //insert into db questions
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    // $th_title = str_replace("<",  "&lt",$th_title);
    // $th_title = str_replace(">",  "&gt",$th_title);

    // $th_desc = str_replace("<",  "&lt",$th_desc);
    // $th_desc = str_replace(">",  "&gt",$th_desc);


    $sno=$_POST['sno'];
     $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `user_id`, `thimestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
     $result = mysqli_query($conn, $sql);
     $showAlert = true;
     if($showAlert){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success!</strong> You thread has been added.Please wait for community to response.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
     }
}
?>





    <div class="container">
        <div class="jumbotron my-2" style="background-color:#E9ECEF;">
            <h1 class="display-4 mx-4">Welcome to <?php echo $catename; ?></h1>
            <p class="lead mx-4"> <?php echo $catedesc; ?></p>
            <hr class="my-0">
            <p class="mx-4 mt-2  pb-3 "> Comments and contributions to forum threads or posts should be descriptive, succinct, and relevant to discussion or forum topic.</p>
           
        </div>


        <?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
            <h1 class="py-2">Start a Discussuion :</h1>


        <form action=" '.$_SERVER["REQUEST_URI"].'>" method="POST">
        <div class="form-group">
            <label for="title">Problem title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">Keep your title as crips and short as possible.</small>
        </div>
        <input type="hidden" name="sno" value="'.$_SESSION['sno'].' ">
        <div class="form-group">
            <label for="desc">Ellaborate your Concern</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success my-2">Submit</button>
    </form>
    </div>';
        }
        else{
            echo ' <div class="container">
            <h1 class="py-2">Start a Discussuion :</h1>
            <p class="lead ">You are not logged in.Please  login to able a start a discussion.</p>
        </div>';
        }

    ?>

   
    

    <h1 class="py-2">Browse Questions :</h1>

        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['thimestamp'];
            $user_id = $row['user_id'];
            $sql2= "SELECT user_email FROM `users` WHERE sno='$user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
           

            echo  '<div class="media my-3">
            <img class="mr-3" src="img/user.png" width="34px" alt="Generic placeholder image">
            <div class="media-body">
            <p class="font-weight-bold my-0"><b> '.$row2['user_email'].'</b> at '.$thread_time.'</p>
                <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '" class="text-dark" >' . $title . '</a></h5>
                ' . $desc . '
            </div>
        </div>';
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid " style="background-color:#E9ECEF">
        <div class="container">
          <p class="display-4">No Questions ...</p>
          <p class="lead pb-3">Be the first person to ask a questions.</p>
        </div>
      </div>';
        }

        ?>
  



    

    </div>





    <?php include "partials/_footer.php" ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>

</html>