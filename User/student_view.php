<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All books</title>
    <link href="sview.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=BioRhyme:wght@800&display=swap" rel="stylesheet"> 

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

    <h1 style='text-align:center; color:white; font-family: BioRhyme, serif;'>HERE ARE ALL THE BOOKS WE HAVE:</h1>
    <div style="margin-left:40%">
        <form action="student_view.php" method="POST">
            <label style="color:white;">Filter by:</label>
            <select name = "category" id = "category" required>
                <option value="all">Select Category</option>
                <option value = "Science">Science</option>
                <option value = "Maths">Maths</option>
                <option value = "Business">Business</option>
                <option value = "Arts">Arts</option>
                <option value = "Language">Language</option>
                <option value = "Technology">Technology</option>
                <option value = "Leisure">Leisure</option>
            </select>
                <button type="submit" name="filter">Filter</button>
        </form>
    </div>


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
                        
                    if(isset($_POST['category']) && $_POST['category'] != "all"){
                        $search = $_POST['category'];
                        $query = "SELECT
                                    *
                                FROM
                                Books 
                                WHERE `Category` = '$search' ";
                        // prepare query statement
                        $stmt = $conn->prepare($query);
                        // execute query
                        $stmt->execute();
                        if($stmt->rowCount() > 0){
                            // Fill the table body with the values
                            echo '<div style="margin-top:100px">';
							while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$title = $result['Title'];       
								$category = $result["Category"];
								$author = $result["Author"];
								$quantity = $result["Quantity"];
                                $book_status = $result["Book_Status"];
                                


                                echo '><div  style="width:30%; margin-bottom:20px;">';
                                
                                    echo 'Title: ';    echo $title; 
                                    echo '<br>Category: ';    echo $category; 
                                    echo '<br>Author:';    echo $author; 
                                    echo '<br>Quantity left: ';    echo $quantity;
                                    echo '<br>Book Status: ';    echo $book_status; 
                                    
                                    if($quantity !=0){
                                        echo "<br><button style = 'color:black'><a href ='borrow_book.php?bid=$result[BookID]' name='Del' style = 'color:black'> Borrow </a></button>";

                                    }else{
                                        echo '<br><br> Out of this book';
                                    }

                                
                                
                                
                                echo '</div>';

                            }
                            echo '</div>';
                        }else{
                            echo 'no records';
                        }

                    }else{

                        //else
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
                    }

                        
?>


    
</body>
</html>