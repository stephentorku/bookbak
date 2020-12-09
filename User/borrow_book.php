<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All books</title>
    <link href="sview.css" rel="stylesheet">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script><link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=BioRhyme:wght@800&display=swap" rel="stylesheet"> 

    <script language="JavaScript" type="text/javascript">
	function checkDelete(){
		return confirm('Are you sure?');
	}
	</script>


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
    <h1 style='text-align:center; color:white; font-family: BioRhyme, serif;'>CHOOSE RETURN DATE AND CONFIRM BOOKING:</h1>



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
                            echo '<div style="margin-top:50px">';
                            while($result = $stmty->fetch(PDO::FETCH_ASSOC)) {
                                $BookID = $result['BookID'];
                                $title = $result['Title'];       
                                $category = $result["Category"];
                                $author = $result["Author"];
                                $quantity = $result["Quantity"];
                                $book_status = $result["Book_Status"];
                                $_SESSION['bookid'] = $BookID;
                                
                                

                                echo '<div class="books" style="width:20%; padding-bottom:20px;display:block; margin:0 auto; line-height:35px">';
                                
                                    echo 'Title: ';    echo $title; 
                                    echo '<br>Category: ';    echo $category; 
                                    echo '<br>Author:';    echo $author; 
                                    echo '<br>Quantity left: ';    echo $quantity;
                                    echo '<br>Book Status: ';    echo $book_status; ?>
                                    
                                    
                                    <br> <div>Enter Return Date: </div>
                                    <form action="confirmborrow.php" method="POST"> 
                                    <input type="date" id="txtDate" name="expdate" style="" placeholder="Enter Date" required>
                                    <?php echo '<br><br><button onclick="return checkDelete()" class="normal" type = "submit" name ="confirmborrow" style="width:150px; padding-bottom:35px"> Confirm Borrow </a></button>  
                                    </form>' ;
                                   
                                
                                
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
