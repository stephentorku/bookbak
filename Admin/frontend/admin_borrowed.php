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

    td{
            color:black
    }
</style>

            <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title" style="color:black; font-size: 16pt;">Books </h4>
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

            $stmt = $book->BorrowedBooks();
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
                            <td><form method= 'post' action ='admin_books.php'>
                                <button type='submit' value ='$row[BookID]' name='delete' style='background-color:#9c2222c9; border:1px solid black; color:white;'> 
                                Delete </button></form>
                            </td>
                                
                        </tr>";}
                echo  "</table>";
            }

            if(isset($_POST['delete'])){
                $query = "DELETE  
                FROM
                    Books
                WHERE
                BookID ='$_POST[delete]'";
                // prepare query statement
                $stmt = $conn->prepare($query);
                // execute query
                $stmt->execute();
                if($stmt->execute() === true){
                    echo '<script>';
                    echo 'swal("Done!", "Book sucessfully deleted!", "success").then(function() {
                        window.location = "admin_books.php";
                    });
                        </script>';
                        return true;  
                }else{
                    echo '<script>';
                    echo 'swal("Unable to Delete!", "Hmm...It seems this book has been borrowed by a user.", "error").then(function() {
                        window.location = "admin_books.php";
                    });
                        </script>';
                        return false;  
                }
                    
            }
                ?>
            </div>
            
            </div>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="rideaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Book </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

    <form action="insertbook.php" method="POST">

        <div class="modal-body">
            <div class="form-group">
                    <label> Book Title </label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Book Title">
            </div>

            <div class="form-group">
                    <label> Author </label>
                    <input type="text" name="author" class="form-control" placeholder="Enter Book Author">
            </div>


            <div class="form-group">
                    <label> Category </label>
                    <input type="text" name="category" class="form-control" placeholder="Enter Book Category">
            </div>


            <div class="form-group">
                    <label> Quantity </label>
                    <input type="number" name="quantity" class="form-control" placeholder="Enter Book Quantity">
            </div>



            
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="insertbook" class="btn btn-primary">Add Ride</button>
        </div>
    </form>



    </div>
    </div>
    </div>
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Edit User Permissions </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="updateride.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label> New Ride Date </label>
                        <input type="date" name="rideDate" class="form-control" placeholder="Enter Date">
                        <input type="hidden" value= " <?php echo $_POST['edit']; ?>" name="rideID">
                    </div>
                    <div class="form-group">
                        <label> New Ride Time </label>
                        <input type="time" name="rideTime" class="form-control" placeholder="Enter Time">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                </div>
            </form>
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