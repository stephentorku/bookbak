<?php
session_start();
include('navbar.php');

    //checks if the variable user is set
    if(isset($_SESSION['fname'])){
        if($_SESSION['role'] == 1){ 
            header("Location:../../User/index.php");    
        }
    }
    else{
        header("location:../../User/loginPage.php"); 
    }


    if(isset($_SESSION['Message'])){
        echo "<script type='text/javascript'>
            alert('" . $_SESSION['errorMessage'] . "');
          </script>";
        unset($_SESSION['Message']);
    }
    
    ?>
 <link href="css/admin.css" id="theme" rel="stylesheet">
 <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=BioRhyme:wght@800&display=swap" rel="stylesheet">
<style>
    th {
         font-weight: 600;
         font-size: 12pt;
         color: white;
         background-color: #c0392b;
    }
    .shadow {
        background-color: #fff;
        /* border-radius */
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        border-radius: 20px;
        /* box-shadow */
        -webkit-box-shadow: rgba(0,0,0,0.8) 0px 0 10px;
        -moz-box-shadow: rgba(0,0,0,0.8) 0 0 10px;
        box-shadow: rgba(0,0,0,0.8) 0 0 10px;
        }
        td{
            color:black
        }


    

</style>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="">
                        <h4 class="page-title" style="color:black; font-size: 16pt; text-align:center; font-family: 'BioRhyme', serif;">OVERDUE BOOKS</h4>
                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
                <?php
                    define('ROOT_PATH', dirname(__DIR__) . '/../');
                    include_once(ROOT_PATH.'User/database.php');
                    include_once(ROOT_PATH.'User/user.php');
                    include_once(ROOT_PATH.'User/books.php');
                    

                    // get database connection
                    $database = new Database();
                    $db = $database->getConnection();
                        
                    $user = new User($db);
                    $query_run = $user->allusers();

                    $users = new User($db);
                    // Return the number of rows in result set
                    $UserRowCount=$query_run->rowCount();

                    //for bus ride count
                    $book = new books($db);
                    $stmt = $book->OverdueBooks();
                   
                    // Return the number of rows in result set
                    
                    
                    ?>
            
                
               

                <!-- /.row -->            
            <div class="row">
                <?php
                $conn = $db;
                $stmt = $book->OverdueBooks();
                if($stmt->rowCount() > 0){
                    //All echos display html elements
                    echo '
                    
                    <table class="table table-dark table-striped shadow">';
                    echo '<thead>
                        <tr>
                            <th style="border-top-left-radius:10px"> Borrowed by (Student ID):
                            <th>Due Date</th>
                            <th>Date borrowed</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th style="border-top-right-radius:10px"> </th>   
                        </tr>
                        </thead>'; 
                    // Fill the table body with the values
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {            
                        echo "<tr>
                                <td>{$row["StudentID"]}</td>
                                <td>{$row["Expected_ReturnDate"]}</td>
                                <td>{$row["Date_Borrowed"]}</td>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Author"]}</td>
                                <td>{$row["Category"]}</td>
                                <td><button class='normal' style='width:180px'><a href ='bookInfo.php?info=$row[BookID]&sid=$row[StudentID]' name='Del' style = 'color:white'> Click to get Student info </a></button></td>                                  
                            </tr>";
                        }
                    echo  "</table>";
                }
                else{
                    echo' <div class="alert alert-danger" style="margin: 60px 0 0 0;">
                    <strong>Hello!</strong> No books due today.</div>';
                }
                    ?>
                    
            </div>


                
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2020 &copy; ASHTRANSIT </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="../plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="../plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    
    </script>
</body>

</html>