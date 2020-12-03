<?php
 
// get database connection
include_once("database.php");
 
// instantiate user object
include_once("user.php");
 
session_start();
$database = new Database();
$db = $database-> getConnection();
 
$user = new User($db);
$errorPassword = "Passwords do not match";
$errorUsername = "Username is not available";
$errorEmail = "Email is not available";
 
// set user property values
$user->fname = $_POST['fname'];
$user->lname = $_POST['lname'];
$user->gender = $_POST['gender'];
$user->dob = $_POST['dob'];
$user->yeargroup = $_POST['year'];
$user->curriculum = $_POST['curriculum'];
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$user->cpassword = base64_encode($_POST['cpassword']);
$user->role = "1";
 
// create the user
if($user->signup()){
    header("Location:loginPage.php");
    }
else{
    if($user->errPass){
        $_SESSION["error"] = $errorPassword;
        header("location: signupPage.php");
    }
    if($user->errUser){
        $_SESSION["error"] = $errorUsername;
        header("location: signupPage.php");
    }
    if($user->errEmail){
        $_SESSION["error"] = $errorEmail;
        header("location: signupPage.php");
    }
}

print_r(json_encode($user_arr));
?>