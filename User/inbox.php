<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All books</title>
    <link href="sview.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=BioRhyme:wght@800&display=swap" rel="stylesheet">

    <script language="JavaScript" type="text/javascript">
	function checkDelete(){
		return confirm('Are you sure you want to delete?');
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
<h1 style='text-align:center; color:white; font-family: BioRhyme, serif;'>Hi <?php echo $_SESSION['fname'];?>,</h1>




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
                        $studentid = $_SESSION['studentID'];

						$title;
						$category;
						$author;
                        $sent;
                        $topic;
                        $memo;
                        $query =  "SELECT DISTINCT
                                    *
                                FROM
                                    messages
                                RIGHT JOIN Books ON messages.BookID = Books.BookID 
                                WHERE messages.StudentID = '$studentid'";

                                $stmt = $conn->prepare($query);
                                // execute query
                                $stmt->execute();

                        if($stmt->rowCount() > 0){

                            echo "<h1 style='text-align:center; color:white; font-family: BioRhyme, serif;'>"; echo'('; echo $stmt->rowCount(); echo ')'; echo " REMINDERS FROM ADMIN:</h1>";


                            // Fill the table body with the values
                            echo '<div style=" overflow-y: scroll; max-height: 450px; margin-bottom:100px;">';
                            
							while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$title = $result['Title'];       
								$category = $result["Category"];
								$author = $result["Author"];
								$sent = $result["date_sent"];
                                $topic = $result["topic"];
                                $memo = $result["memo"];
                                
                                
                                echo '<div style="height:50px"></div>';
                                echo '<div class="books" style="width:40%; margin-bottom:20px;display:block; margin:0 auto; text-align:center;">';
                                    echo'<strong>Message from Admin </strong>';
                                    echo '<div class="message">';
                                    echo 'Subject: ';    echo $topic; 
                                    echo '<br>Message: ';    echo $memo; 
                                    echo '</div><br><br>';
                                    
                                    echo 'Title: ';    echo $title; 
                                    echo '<br>Category: ';    echo $category; 
                                    echo '<br>Author: ';    echo $author; 
                                    echo '<br>Date received: ';    echo $sent;

                                    


                                    echo' <br><br><a onclick="return checkDelete()" href ="inbox.php?bid='; echo "$result[BookID]"; echo'" name="Del" class="red" style="padding:10px;">Delete message</a><br><br>';

                                echo '</div>';

                            }
                            echo '</div><br>';
                        }else{
                            echo '<div class="alert alert-danger nobooks">
                            <strong>Hello!</strong> You have no messages.</div>';
                        }




                        if(isset($_GET['bid'])){
                            $bookid = $_GET['bid'];
							$query = "DELETE  
							FROM
								`messages`
							WHERE
							BookID = '$bookid' AND StudentID = '$studentid'"  ;
							// prepare query statement
							$stmt = $conn->prepare($query);
							// execute query
							$stmt->execute();
							if($stmt->execute() === true){
								echo "<script>";
								echo "alert('Done! Message deleted sucessfully.');      
									window.location.href='inbox.php';
									</script>";
									return true;  
							}else{
								echo '<script>'; 
								echo 'alert("Error! Unable to delete"); 
									window.location.href="inbox.php"; 
									</script>';
									return false;
							}		
						}

                        
?>


    
</body>
</html>