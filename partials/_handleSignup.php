<?php
$showError="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $name=$_POST['user'];
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    //already exits in thisemail check
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows - mysqli_num_rows($result);
    if($numRows>0){
        $showError="Email is already exits";
    }
    else{
        if($pass==$cpass){
            $hash = password_hash($pass ,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `user_name`, `user_email`, `user_pass`, `timestamp`) VALUES ( '$name', '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
                header("Location:/forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError= "Password do not match";
            
        }
    }
    header("Location:/forum/index.php?signupsuccess=false&error=$showError");
}



?>