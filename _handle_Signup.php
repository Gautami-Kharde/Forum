<?php

$showAlert = "false";
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_name = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass =  $_POST['signupcPassword'];


    //check whether email exists
    $existSql = "select * from users where user_email = '$user_name'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already registered.";

    }
    else{
            if($pass == $cpass){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "insert into users(user_email, user_pass, time) values('$user_name', '$hash', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $showAlert = true;
                    header("Location:\Forum\index.php?signupsuccess=true");
                    exit();
                   }
            }
            else{
                $showError = "Passwords do not match.";
            }
        }
        header("Location:\Forum\index.php?signupsuccess=false&error=$showError");
        
}    

?>