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

    .details{
        width: 400px; 
        display:block; 
        margin:0 auto; 
        background-color:white;
        border: 1px solid black;
        border-radius:10px;
        padding-bottom:10px;
    }
    .normal {
        border-color: #c0392b;
        background-color: #c0392b;
        color: #fff;
        -webkit-transition: all 150ms ease-in-out;
        transition: all 150ms ease-in-out;
        border-radius: 10px;
        width:100px;
        height:30px;
        border-style:none;
        padding: 5px;
        margin-left:15px;
        }
        .normal:hover {
        box-shadow: 0 0 5px 0 #c0392b inset, 0 0 5px 2px #c0392b;
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
                <h4 class="page-title" style="color:black; font-size: 16pt;">More Info: Book #<?php echo $_GET['info']?>  is borrowed by this student: </h4>
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
                $curdate = date("Y-m-d");
             //For specific Book information
                
                $sql= "SELECT
                            *
                        FROM
                            `Students`
                            WHERE StudentID = '$studentid'";
                $stmty = $conn->prepare($sql);
                $stmty->execute();
                
                

                
                
            
                if($stmty->rowCount() > 0){
                    //All echos display html elements
                    while($row = $stmty->fetch(PDO::FETCH_ASSOC)) { 
                    echo '
                        
                        <div class = "container-fluid" >
                        <div class="card details shadow" style="color:black; text-transform:capitalize" >
                        
                        <div class="card-body">
                            <h5 class="card-title" style="text-align:center">Student Details<br><br></h5>
                            <p class="card-text"></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name: '; echo$row['fname']; echo' ';echo$row['lname']; echo' </li>
                            <li class="list-group-item">Gender: '; echo$row['gender']; echo' </li>
                            <li class="list-group-item">Year: '; echo$row['yeargroup']; echo' </li> 
                            <li class="list-group-item">Curriculum: '; echo$row['curriculum']; echo' </li>
                            <li class="list-group-item" style="text-transform:none">Email: '; echo$row['email'];echo'</li>
                        </ul>
                       
                            
                            <a style="width:150px href="#" class="normal" data-toggle="modal" data-target="#editmodal">Send email</a>
                        
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
                    <form action="message.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group" >
                                <label> Subject </label>
                                <input type = "text" name="subject" style="display:block; width: 95%;">
                                <input type = "hidden" name="studentID" value="<?php echo $studentid;?>">
                                <input type = "hidden" name="bookID" value="<?php echo $bookid;?>">
                                
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
