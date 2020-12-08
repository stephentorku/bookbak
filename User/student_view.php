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
        include_once('navmenu.php');
    }
    else{    
        header("Location:loginPage.php");
    }?>


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
                        $stmt = $book->allbooks();
                        if($stmt->rowCount() > 0){
                            // Fill the table body with the values
                            echo '<div style="margin-top:100px">';
							while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$title = $result['Title'];       
								$category = $result["Category"];
								$author = $result["Author"];
								$quantity = $result["Quantity"];
                                $book_status = $result["Book_Status"];
                                


                                echo '><div class="books" style="width:50%; margin-bottom:20px;">';
                                
                                    echo 'Title: ';    echo $title; 
                                    echo '<br>Category: ';    echo $category; 
                                    echo '<br>Author:';    echo $author; 
                                    echo '<br>Quantity left: ';    echo $quantity;
                                    echo '<br>Book Status: ';    echo $book_status; 
                                    
                                    if($quantity !=0){
                                        echo "<br><button style = 'color:red'><a href ='borrow_book.php?bid=$result[BookID]' name='Del' style = 'color:red'> Borrow </a></button>";

                                    }else{
                                        echo '<br><br> Out of this book';
                                    }

                                
                                
                                
                                echo '</div>';

                            }
                            echo '</div>';
                        }else{
                            echo 'no records';
                        }

                        
?>


    
</body>
</html>