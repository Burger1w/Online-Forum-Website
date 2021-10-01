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

<style>
    .container{
        min-height: 100vh;
    }
</style>
  <title>Welcome to iDiscuss</title>
</head>

<body>

  <?php include "partials/_dbconnect.php" ?>
  <?php include "partials/_header.php" ?>



 <div class="container">  
<div class="searchResults">
    <h1 class="py-3">Search Results for <em>'<?php echo $_GET['search']; ?>'</em></h1>
    <?php
$noresult= true;
$query = $_GET["search"];
$sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) against ('$query')";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
     $title = $row['thread_title'];
     $desc = $row['thread_desc'];
     $thread_id=$row['thread_id'];
     $url="thread.php?threadid=".$thread_id;
     $noresult=false;
     //display search result
     echo ' <div class="result">
     <h3>
         <a href="'.$url.'" class="text-dark">'.$title.'</a>
         </h3>
         <p>'.$desc.'</p>
    </div>';
}

if($noresult){
    echo '<div class="jumbotron jumbotron-fluid" style="background-color:#E9ECEF;">
    <div class="container">
      <h1 class="display-4">No results found</h1>
      <p class="lead">
      
      Your search - '.$query.' - did not match any documents.

        <p>Suggestions:<ul>

       <li> Make sure that all words are spelled correctly.</li>
       <li> Try different keywords.</li>
        <li>Try more general keywords.</li>
        </ul>
        </p>
      
      </p>
    </div>
  </div>';
}

?>
   
</div>
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
   
<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>



</body>

</html>