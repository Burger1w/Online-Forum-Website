<?php
session_start();


echo 

'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./about.php">About</a>
        </li>



      
     

    <div class="dropdown nav-link text-light ">
      <a class="dropdown-toggle text-light   text-decoration-none " data-toggle="dropdown" href="/forum">Top Category</a>
      <ul class="dropdown-menu mx-3" role="menu" aria-labelledby="dLabel">  ';

       $sql ="SELECT  category_name, category_id FROM `categories` ";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {          
        echo '<li><a class="mx-3 mt-1  text-decoration-none text-success" href="threadslist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>
        <li class="divider"></li>';
      }
      echo '</ul>
    </div>   
   




        
        <li class="nav-item">
          <a class="nav-link " href="./contact.php" >Contact</a>
        </li>
      </ul>

     <div class="row-mx-2">'; 
     

     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<form class="d-flex" action="search.php" method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      
       <a href = "partials/_logout.php" class="btn btn-outline-success mx-2" >LogOut</></a>
        <p class="text-light my-0 mx-3 text-center">   Welcome <i>'.$_SESSION['useremail'].'</i></p>
        </form>';
    }

    else{
      echo ' <form class="d-flex" action="search.php" method="GET">
      <input class="form-control me-2" type="search " name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      
      <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#loginModel">Login</button>
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#signupModel">SignUp</button>
      </form>';
    }
    
     

    echo '</div>
  </div>
</nav>';

include "partials/_loginModal.php";
include "partials/_signupModal.php";

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You con now login using your email and password.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}



// <div class="dropdown">
// <a class="dropdown-toggle  text-light  text-decoration-none"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//  Category
// </a>
// <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
//   <a class="dropdown-item" href="threadslist.php?catid=1">Python</a>
//   <a class="dropdown-item" href="threadslist.php?catid=2">java Script</a>
//   <a class="dropdown-item" href="threadslist.php?catid=3">Php</a>
// </div>
// </div>