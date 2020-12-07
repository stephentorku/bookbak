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
                                    echo '<br>Book Status: ';    echo $book_status;
                                    echo '<br>Return Date: ';    echo $return_date;
                                    echo' <br><br><a href ="mybooks.php?bid='; echo "$result[BookID]"; echo'" name="Del" class="likeabutton">Return Book</a>';
                                
                                
                                
                                echo '</div>';

                            }
                            echo '</div>';
                        }else{
                            echo '<p style="color:white">no records</p>';
                        }
                        $studentid=$_SESSION['studentID'];
                        
                        if(isset($_GET['bid'])){
                            $bookid = $_GET['bid'];
							$query = "DELETE  
							FROM
								`Borrowed_books`
							WHERE
							BookID = '$bookid' AND StudentID = '$studentid'"  ;
							$increasequantity = "UPDATE Books SET Quantity = Quantity + 1 WHERE BookID = '$bookid'";
							$stmt1 = $conn->prepare($increasequantity);
							// prepare query statement
							$stmt = $conn->prepare($query);
							// execute query
							$stmt->execute();
							if($stmt->execute() === true){
								$stmt1->execute();
								echo "<script>";
								echo "alert('Done! Book returned sucessfully.');      
									window.location.href='mybooks.php';
									</script>";
									return true;  
							}else{
								echo '<script>'; 
								echo 'alert("Error! Unable to Cancel"); 
									window.location.href="mybooks.php"; 
									</script>';
									return false;
							}		
						}

                        
?>


    
</body>
</html>