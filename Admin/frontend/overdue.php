<?php
define('ROOT_PATH', dirname(__DIR__) . '/../');

//Get database connection
include(ROOT_PATH.'User/database.php');

// instantiate user object
include(ROOT_PATH.'User/books.php');

include('navbar.php');

session_start();
//checks if the variable user is set
if(isset($_SESSION['fname'])){ 
    if($_SESSION['role'] ==1){ 
        header("Location:../../User/index.php");
    }    
}else{
    header("location:../../User/LoginPage.php"); 
}

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    th {
         font-weight: 600;
         font-size: 12pt;
         color: white;
         background-color: #9c2222c9;
    }
</style>

            <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title" style="color:black; font-size: 16pt;"> Overdue Books </h4>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            <div>
            <?php
            // get database connection
            $database = new Database();
            $db = $database->getConnection();
                
            // prepare user object
            $book = new books($db);
            $conn = $db;

            $stmt = $book->OverdueBooks();
            if($stmt->rowCount() > 0){
                //All echos display html elements
                echo '
                
                <table class="table table-dark table-striped">';
                echo '<thead>
                    <tr>
                        <th>BookID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th> </th>   
                        
                    </tr>
                    </thead>';
                // Fill the table body with the values
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {            
                    echo "<tr>
                            <td>{$row["BookID"]}</td>
                            <td>{$row["Title"]}</td>
                            <td>{$row["Category"]}</td>
                            <td>{$row["Author"]}</td>
                            <td>{$row["Quantity"]}</td>
                            <td><button> Send Email </td>
                            
                                
                        </tr>";}
                echo  "</table>";
            }

            
                ?>
            </div>
           
            </div>
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
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
</body>
</html>