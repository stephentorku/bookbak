<?php
define('ROOT_PATH', dirname(__DIR__) . '/../');
include(ROOT_PATH.'User/database.php');
include_once(ROOT_PATH.'User/user.php');
include_once(ROOT_PATH.'User/books.php');

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
<style>
    th {
        font-weight: 600;
        font-size: 12pt;
        color: white;
        background-color: #9c2222c9;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 20%;
        border-radius: 50%;
    }
</style>

            <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title" style="color:black; font-size: 16pt;">More Info: Book# <?php echo $_GET['info']?>  </h4>
            </div>
        </div>
        <?php
            // get database connection
            $database = new Database();
            $db = $database->getConnection();
            $conn = $db;

            $bookid = $_GET['info'];
            $studentid = $_GET['sid'];

            
            if(isset($_GET['info'])){
                //For specific Ride information
                
                $sql= "SELECT
                            *
                        FROM
                            `Students`
                            WHERE StudentID IN(SELECT StudentID FROM Borrowed_books WHERE BookID ='{$_GET['info']}')";
                $stmty = $conn->prepare($sql);
                $stmty->execute();
                
                

                
                
            
                if($stmty->rowCount() > 0){
                    //All echos display html elements
                    while($row = $stmty->fetch(PDO::FETCH_ASSOC)) { 
                    echo '
                        <div class="card" style="width: 18rem; display:block; margin:0 auto; background-color:white;">
                        <img src="../../User/images/person.png" class="card-img-top" alt="..." style="width:100%">
                        <div class="card-body">
                            <h5 class="card-title">Student Details<br><br></h5>
                            <p class="card-text"></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name: '; echo$row['fname']; echo' </li>
                            <li class="list-group-item">Lastt name:'; echo$row['lname']; echo' </li>
                            <li class="list-group-item">Year:'; echo$row['yeargroup']; echo' </li>
                            <li class="list-group-item">Curriculum: '; echo$row['curriculum']; echo' </li>
                            <li class="list-group-item">Email'; echo$row['email'];echo'</li>
                        </ul>
                        <div class="card-body">
                            
                            <a href="#" class="card-link">Send email</a>
                        </div>
                        </div>
                    ';
                    // Fill the table body with the values
                    
                        }
                    echo  "</table>";
                }else{
                    echo '
                    <div class="alert alert-danger" style="margin: 10px 0 0 0; background-color: rgb(151, 17, 17);">
                    <strong>something went wrong :(  !</strong> .
                    </div>';
                }
            }
        ?>
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="email.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group" >
                                <label> Subject </label>
                                <input type = "text" name="subject" style="display:block; width: 95%;">
                                <input type = "hidden" name="rideID" value="<?php echo $id?>">
                                
                            </div>
                            <div class="form-group">
                                <label> Message </label>
                                <textarea cols="75" rows="5" name="message"></textarea>
                            </div>
                            <p><b>*This e-mail will be sent to all users who have booked this ride.</b><p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="send" class="btn btn-primary">Send</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center"> 2020 &copy; ASHTRANSIT </footer>      
</div>

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
