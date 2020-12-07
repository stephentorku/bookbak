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
 

$book->title = $_POST['title'];
$book->author = $_POST['author'];
$book->category=$_POST['category'];
$book->quantity=$_POST['quantity'];
$book->book_status = 'good condition';



if($book->InsertBook()){
    echo '<script defer>';
    echo 'swal("Done!", "Book was added successfully!", "success").then(function() {
        window.location = "admin_books.php";
    });
    </script>';
}else{
    echo '<script defer>';
    echo 'swal("Something went wrong!", "Sorry, Book insertion failed!", "error").then(function() {
        window.location = "admin_books.php";
    });
    </script>';
}

?>