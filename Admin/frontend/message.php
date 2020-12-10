<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
//Navigate to appropriate directory for files
define('ROOT_PATH', dirname(__DIR__) . '/../');

//Get database connection
include(ROOT_PATH.'User/database.php');

// instantiate user object
include(ROOT_PATH.'User/books.php');

session_start();
//checks if the variable user is set
if(isset($_SESSION['fname'])){    
    echo '<h5 style="color: white;">Welcome ' . $_SESSION['fname'] . ',</h5>'; 
} 

else{    
    header("Location:loginPage.php");
}  

$database = new Database();
$db = $database-> getConnection();
$book = new books($db); 
$conn = $db;                      
 

$topic = $_POST['subject'];
$memo = $_POST['message'];
$bookid=$_POST['bookID'];
$studentid=$_POST['studentID'];
$sent = date('Y-m-d');

$query = "INSERT INTO `messages`(`date_sent`, `topic`,`memo`,`StudentID`,`BookID`) VALUES('$sent','$topic','$memo','$studentid','$bookid')";
    
    // prepare query statement
    $stmt = $conn->prepare($query);
    // execute query
    $stmt->execute();



if($stmt->execute()){
    echo '<script defer>';
    echo 'swal("Done!", "Message sent successfully!", "success").then(function() {
        window.location = "overdue.php";
    });
    </script>';
}else{
    echo '<script defer>';
    echo 'swal("Something went wrong!", "Sorry, Message was not sent!", "error").then(function() {
        window.location = "overdue.php";
    });
    </script>';
}

?>