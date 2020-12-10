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

    .details{
        width:30%;
        border-radius:10px;
        display:block;
        margin:0 auto;
        margin-top:50px;
        margin-bottom:50px;


    }
    li{
        border:0px ;
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
</style>

            <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4 class="page-title" style="color:black; font-size: 16pt;">More Info: Student#<?php echo $_GET['sid']?>  has borrowed these books: </h4>
            </div>
        </div>
        <?php
            // get database connection
            $database = new Database();
            $db = $database->getConnection();
            $conn = $db;

            
            $studentid = $_GET['sid'];

            
            if(isset($_GET['sid'])){
                $curdate = date("Y-m-d");
             //For specific Ride information
                
                $sql= "SELECT
                            *
                        FROM
                            `Books`
                            WHERE BookID IN(SELECT BookID FROM Borrowed_books WHERE StudentID ='$studentid')";
                $stmty = $conn->prepare($sql);
                $stmty->execute();
                
                

                
                
            
                if($stmty->rowCount() > 0){
                    //All echos display html elements
                    echo '<div style=" overflow-y: scroll; max-height: 340px; margin-bottom:100px; width:70%; display:block; margin:0 auto;">';
                    while($row = $stmty->fetch(PDO::FETCH_ASSOC)) { 
                    echo '
                        
                        <ul class="list-group list-group-flush details shadow">
                            <li style="border-top-left-radius:20px;border-top-right-radius:20px" class="list-group-item">BookID: '; echo$row['BookID']; echo' </li>
                            <li class="list-group-item">Title: '; echo$row['Title']; echo' </li>
                            <li class="list-group-item">Author: '; echo$row['Author']; echo' </li>
                            <li style="border-bottom-left-radius:20px;border-bottom-right-radius:20px" class="list-group-item">Category: '; echo$row['Category']; echo' </li>
                            
                        </ul>
                        
                    ';
                    // Fill the table body with the values
                    
                        }
                        echo '</div>';
                }else{
                    echo '
                    <div class="alert alert-danger nobooks">
                    <strong>Seems like this student has not borrowed any books</strong>
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
    <footer class="footer text-center"> 2020 &copy; BOOKBAK </footer>      
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
