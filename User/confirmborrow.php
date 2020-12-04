<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include_once "database.php";
include_once "books.php";

session_start();
//checks if the variable user is set
if(isset($_SESSION['fname'])){    
    echo '<h5 style="color: white;">Welcome ' . $_SESSION['fname'] . ',</h5>'; 
} 

else{    
    header("Location:loginPage.php");
}  

// get database connection
$database = new Database();
$db = $database->getConnection();
 

// prepare user object
$book = new books($db);
$conn = $db;

$date = date("Y-m-d", strtotime($_POST['expdate']));
$studentid = $_SESSION['studentID'];
$bookid = $_SESSION['bookid'];
$curdate = date("Y-m-d");

if(isset($date)){
    $query = "INSERT INTO `Borrowed_books`(`Expected_ReturnDate`, `Date_Borrowed`,`StudentID`,`BookID`) VALUES('$date','$curdate','$studentid','$bookid')";
    
    // prepare query statement
    $stmt = $conn->prepare($query);
    // execute query
    $stmt->execute();
    echo '<script>';
    echo 'swal("Done!", "Book was sucessfully booked.", "success").then(function() {
        window.location = "mybooks.php";
    });
    ;
    </script>';
    return $stmt;
    

}?>