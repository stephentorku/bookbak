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

    $checkquery="SELECT * FROM `Borrowed_books` WHERE StudentID = '$studentid' AND BookID = '$bookid'";
    $stmt0 = $conn->prepare($checkquery);
    $stmt0->execute();
    $check=$stmt0->rowCount();
    if($check==0){
        $query = "INSERT INTO `Borrowed_books`(`Expected_ReturnDate`, `Date_Borrowed`,`StudentID`,`BookID`) VALUES('$date','$curdate','$studentid','$bookid')";
    
        // prepare query statement
        $stmt = $conn->prepare($query);
        // execute query
        $stmt->execute();
        $reducequantity = "UPDATE Books SET Quantity = Quantity - 1 WHERE BookID = '$bookid'";
        $stmt1 = $conn->prepare($reducequantity);
        $stmt1->execute();
        echo '<script>';
        echo 'swal("Done!", "Book was sucessfully borrowed.", "success").then(function() {
            window.location = "mybooks.php";
        });
        ;
        </script>';
        return $stmt;


    }else{
        echo '<script>';
        echo 'swal("Sorry!", "Seems like you have already borrowed this boook.", "success").then(function() {
            window.location = "student_view.php";
        });
        ;
        </script>';
    }

    
    

}?>