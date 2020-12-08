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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=BioRhyme:wght@800&display=swap" rel="stylesheet"> 

<style>
    th {
         font-weight: 600;
         font-size: 12pt;
         color: white;
         background-color: #9c2222c9;
    }

    .white-box{
        border: 2px ;
        border-radius:10px;
    }
    .nobooks{
        width:40%; 
        display:block;
        margin: 0 auto;
        margin-top:50px; 
        background-color: #c0392b;
        font-size:20px;
        text-align: center;
        border-radius:10px;
    }

    .shadow {
        background-color: #fff;
        width:280px;
        margin:5px;
        border: 1px solid #1f2f46;
        /* border-radius */
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        border-radius: 20px;
        /* box-shadow */
        -webkit-box-shadow: rgba(0,0,0,0.8) 0px 0 10px;
        -moz-box-shadow: rgba(0,0,0,0.8) 0 0 10px;
        box-shadow: rgba(0,0,0,0.8) 0 0 10px;
        }

</style>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="">
                        <h4 class="page-title" style="color:#1f2f46; font-size: 16pt; text-align:center; font-family: 'BioRhyme', serif;">DASHBOARD</h4>
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
                    $stmtborrowed = $book->BorrowedBooks();
                    
                    // Return the number of rows in result set
                    $BookRowCount=$stmt->rowCount();
                    $DayBookRowCount=$stmtday->rowCount();
                    $BorrowedBooksCount = $stmtborrowed->rowCount();
                    ?>
            
                
                <!-- row -->
                <div class="row">
                    <!--col -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shadow" style="">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: #1f2f46; padding: 10px 0; font-weight:bolder;">
                                    Registered Users:</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: "><?php
                                    echo $UserRowCount;?></h3><!-- query to count all users -->
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!--col -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shadow">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: #1f2f46; padding: 10px 0; font-weight:bolder;">
                                    Number of Books: </h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: #1f2f46;"><?php
                                    echo $BookRowCount;?></h3><!-- query to count all users -->
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!--col -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shadow">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: #1f2f46; padding: 10px 0; font-weight:bolder;">
                                    Books due today: </h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: #1f2f46;"><?php
                                    echo $DayBookRowCount;?></h3><!-- query to count all users -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shadow">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: #1f2f46; padding: 10px 0; font-weight:bolder;">
                                    Borrowed books:</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: #1f2f46;"><?php
                                    echo $BorrowedBooksCount;?></h3><!-- query to count all users -->
                                </div> 
                            </div>
                        </div>
                    </div>

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
                            <th> Borrowed by (Student ID):
                            <th>Due Date</th>
                            <th>Date borrowed</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th> </th>   
                        </tr>
                        </thead>'; 
                    // Fill the table body with the values
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {            
                        echo "<tr>
                                <td>{$row["StudentID"]}</td>
                                <td>{$row["Expected_ReturnDate"]}</td>
                                <td>{$row["Date_Borrowed"]}</td>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Author"]}</td>
                                <td>{$row["Category"]}</td>
                                <td><button style = 'color:red'><a href ='bookInfo.php?info=$row[BookID]&sid=$row[StudentID]' name='Del' style = 'color:red'> Click to get Student info </a></button></td>                                  
                            </tr>";
                        }
                    echo  "</table>";
                }
                else{
                    echo' <div class="alert alert-danger nobooks">
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