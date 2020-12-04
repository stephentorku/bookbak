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
        header("location:../../User/LoginPage.php"); 
    }


    if(isset($_SESSION['Message'])){
        echo "<script type='text/javascript'>
            alert('" . $_SESSION['errorMessage'] . "');
          </script>";
        unset($_SESSION['Message']);
    }
    
    ?>
 

<style>
    th {
         font-weight: 600;
         font-size: 12pt;
         color: white;
         background-color: #9c2222c9;
    }

    .white-box{
        border: 2px solid orange;
    }

</style>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title" style="color:black; font-size: 16pt;">Dashboard</h4>
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
                    $stmt = $book->allbooks();
                    $stmtday = $book->DayBooks();
                    
                    // Return the number of rows in result set
                    $BookRowCount=$stmt->rowCount();
                    $DayBookRowCount=$stmtday->rowCount();
                    ?>
            
                
                <!-- row -->
                <div class="row">
                    <!--col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Registered Users:</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;"><?php
                                    echo $UserRowCount;?></h3><!-- query to count all users -->
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!--col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Number of Books: </h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;"><?php
                                    echo $BookRowCount;?></h3><!-- query to count all users -->
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!--col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Books due today: </h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;"><?php
                                    echo $DayBookRowCount;?></h3><!-- query to count all users -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>



                <!-- /.row -->            
            <div class="row">
                <?php
                $conn = $db;
                $stmt2=$book->DayBooksDisplay();
                if($stmt2->rowCount() > 0){
                    //All echos display html elements
                    echo '
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title" style="color:black; font-size: 16pt;">Books due today:</h4>
                        </div>
                    </div>
                    <table class="table table-dark table-striped">';
                    echo '<thead>
                        <tr>
                            <th>Due Date</th>
                            <th>Date borrowed</th>
                            <th>Borrowed by (Student ID) :</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th> </th>   
                        </tr>
                        </thead>'; 
                    // Fill the table body with the values
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {            
                        echo "<tr>
                                <td>{$row["Expected_ReturnDate"]}</td>
                                <td>{$row["Date_Borrowed"]}</td>
                                <td style='text-align:center'>{$row["StudentID"]}</td>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Author"]}</td>
                                <td>{$row["Category"]}</td>
                                <td><button style = 'color:red'><a href ='rideInfo.php?info=$row[BookID]&sid=$row[StudentID]' name='Del' style = 'color:red'> More Info </a></button></td>                                  
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