<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All books</title>
    <link href="sview.css" rel="stylesheet">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>

</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['fname'])){  
        include_once('navbar.php');
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
                        $bookid = $_GET['bid'];
                        $studentid = $_SESSION['studentID'];

                        
                        if(isset($_GET['bid'])){
                            //For specific Book information
                            
                            $sql= "SELECT
                                        *
                                    FROM
                                        `Books`
                                        WHERE BookID = '$bookid'";
                            $stmty = $conn->prepare($sql);
                            $stmty->execute();
                
                        if($stmty->rowCount() > 0){

                            echo"<script>
                            $(function(){
                                var dtToday = new Date();
                                
                                var month = dtToday.getMonth() + 1;
                                var day = dtToday.getDate();
                                var year = dtToday.getFullYear();
                                var future = dtToday.getDate() + 14; 
                                if(month < 10)
                                    month = '0' + month.toString();
                                if(day < 10)
                                    day = '0' + day.toString();
                                if(future < 10)
                                    future = '0' + future.toString();
                                    
                                
                                var minDate= year + '-' + month + '-' + day;
                                var maxDate= year + '-' + month + '-' + future;
                                
                                $('#txtDate').attr('min', minDate);
                                $('#txtDate').attr('max', maxDate);
                            });
                            </script>
                            ";
                            // Fill the table body with the values
                            echo '<div style="margin-top:100px">';
                            while($result = $stmty->fetch(PDO::FETCH_ASSOC)) {
                                $BookID = $result['BookID'];
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
                                    echo'<br> Enter Return Date: <form action="confirmborrow.php" method="POST" > <input type="date" id="txtDate" name="expdate" class="form-control" placeholder="Enter Date"></form>';
                                    echo '<button><a href ="confirmborrow.php?bid='; echo "$BookID"; echo'" style = "text-decoration: none;"> Confirm Borrow </a></button>';
                                
                                
                                
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
