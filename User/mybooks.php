<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All books</title>
    <link href="sview.css" rel="stylesheet">

</head>
<body>
    <?php
    session_start();

    
    if(isset($_SESSION['fname'])){  
        include_once('navbar.php');
    }
    else{    
        header("Location:loginPage.php");
    } ?>




<?php 
						// include database and object files
						include_once "database.php";
						include_once "books.php";
						// get database connection
						$database = new Database();
						$db = $database->getConnection();
						$conn = $db;
							
						// prepare user object
						$book = new books($db);
						
						//Set variables
						$title;
						$category;
						$author;
						$quantity;
                        $book_status;
                        $return_date;
                        $borrow_date;
                        $stmt = $book->getStudentBooks();
                        if($stmt->rowCount() > 0){
                            // Fill the table body with the values
                            echo '<div style="margin-top:100px">';
							while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$title = $result['Title'];       
								$category = $result["Category"];
								$author = $result["Author"];
								$quantity = $result["Quantity"];
                                $book_status = $result["Book_Status"];
                                $return_date = $result["Expected_ReturnDate"];
                                $borrow_date = $result["Date_Borrowed"];

                                

                                echo '><div class="books" style="width:50%; margin-bottom:20px;">';
                                
                                    echo 'Title: ';    echo $title; 
                                    echo '<br>Category: ';    echo $category; 
                                    echo '<br>Author:';    echo $author; 
                                    echo '<br>Quantity left: ';    echo $quantity;
                                    echo '<br>Book Status: ';    echo $book_status;
                                    echo '<br>Return Date: ';    echo $return_date;
                                    echo '<br> Date: ';    echo $return_date;
                                    echo '<br><button>Return Book</button>';
                                
                                
                                
                                echo '</div>';

                            }
                            echo '</div>';
                        }else{
                            echo 'no records';
                        }

                        
?>


    
</body>
</html>