<?php
define('ROOT_PATH', dirname(__DIR__) . '/../');
include(ROOT_PATH.'User/database.php');
include_once(ROOT_PATH.'User/user.php');
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
                <h4 class="page-title" style="color:black; font-size: 16pt;">More Info: Ride# <?php echo $_GET['info']?>  </h4>
            </div>
        </div>
        <?php
            // get database connection
            $database = new Database();
            $db = $database->getConnection();
            $conn = $db;

            $id = $_GET['info'];
            
            if(isset($_GET['info'])){
                //For specific Ride information
                $sql = "SELECT * FROM Books WHERE BookID =".$_GET['info'];
                $stmty = $conn->prepare($sql);
                $stmty->execute();
                
                

                $result = $stmty->fetch(PDO::FETCH_ASSOC);
                
            
                if($stmty->rowCount() > 0){
                    //All echos display html elements
                    echo'
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box" style = "margin-bottom: 13px;" >    
                            <p> Pickup: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span></p>
                            <p> Destination: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span></p>
                            <p> Route: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span>
                                Time: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span>
                            </p>
                        </div> 
                    </div>
                        
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Ride Capacity</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;">';
                                    echo '#'; 
                                    echo'</h3>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Slots Remaining</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;">';
                                    echo '#'; 
                                    echo'</h3>
                                </div> 
                            </div>
                        </div>
                    </div>
                   
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title" style="color:black; font-size: 16pt;"> Booked By: </h4>
                        </div>
                    </div>'; 
                    echo '<table class="table table-dark table-striped">';
                    echo '<thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>contact</th>
                            <th>Email</th>
                            <th><button data-toggle="modal" data-target="#editmodal" style="color:black; border:solid 2px black; border-radius:10px;">
                                Send Email</button>
                            </th>    
                        </tr>
                        </thead>';
                    // Fill the table body with the values
                    while($row = $stmty->fetch(PDO::FETCH_ASSOC)) {            
                        echo "<tr>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Title"]}</td>
                                <td>{$row["Title"]}</td>  
                                <td></td>  
                            </tr>";}
                    echo  "</table>";
                }else{
                    echo '
                    <div class= "row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box" style= "margin-bottom: 13px;">    
                            <p> Pickup: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span></p>
                            <p> Destination: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span></p>
                            <p> Route: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span>
                                Time: <span style="color: green; font-weight:bolder;">'; echo '#'; echo '</span>
                            </p>
                        </div> 
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Ride Capacity</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;">';
                                    echo '#'; 
                                    echo'</h3>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb" style="color: black; padding: 10px 0; font-weight:bolder;">
                                    Slots Remaining</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger" style="color: green;">';
                                    echo '#'; 
                                    echo'</h3>
                                </div> 
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title" style="color:black; font-size: 16pt;"> Booked By: </h4>
                        </div>
                    </div>
                    <div class="alert alert-danger" style="margin: 10px 0 0 0; background-color: rgb(151, 17, 17);">
                    <strong>No records found!</strong> It seems no one has booked this ride yet.
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
