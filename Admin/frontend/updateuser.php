<?php
//Navigate to appropriate directory for files
define('ROOT_PATH', dirname(__DIR__) . '/../');

//Get database connection
include(ROOT_PATH.'User/database.php');

 
session_start();
$database = new Database();
$db = $database-> getConnection();
$conn = $db;

    if(isset($_POST['updatedata']))
    {   
        
        $userid=$_POST['StudentID'];
        $role=$_POST['role'];

        $query = "UPDATE Students SET role=".$role."
         WHERE StudentID=". $userid;
        $stmt = $conn->prepare($query);
        $true = $stmt->execute();

        if($true)
        {   echo "<script defer>";
            echo "alert('Done! Edit Sucessfull');      
            window.location.href='users.php';
                </script>";
        }
        else
        {   echo $userid;
            echo "<script defer>";
            echo "alert('Error! Unable to Edit. Please store user ID first.');
            window.location.href='users.php';      
                </script>";
        }
        
    }
?>