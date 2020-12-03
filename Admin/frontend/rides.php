<?php
define('ROOT_PATH', dirname(__DIR__) . '/../');

//Get database connection
include(ROOT_PATH.'User/database.php');

// instantiate user object
include(ROOT_PATH.'User/rides.php');

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
                    <h4 class="page-title" style="color:black; font-size: 16pt;">Bus Rides </h4>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            <div>
            <?php
            // get database connection
            $database = new Database();
            $db = $database->getConnection();
                
            // prepare user object
            $rides = new rides($db);
            $conn = $db;

            $stmt = $rides->AllRides();
            if($stmt->rowCount() > 0){
                //All echos display html elements
                echo '
                
                <table class="table table-dark table-striped">';
                echo '<thead>
                    <tr>
                        <th>RideDate</th>
                        <th>RideTime</th>
                        <th>Capacity</th>
                        <th>Route</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th> </th>   
                        
                    </tr>
                    </thead>';
                // Fill the table body with the values
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {            
                    echo "<tr>
                            <td>{$row["rideDate"]}</td>
                            <td>{$row["rideTime"]}</td>
                            <td>{$row["capacity"]}</td>
                            <td>{$row["route"]}</td>
                            <td>{$row["pickup"]}</td>
                            <td>{$row["destination"]}</td>
                            <td><form method= 'post' action ='rides.php'>
                                <button type='submit' value ='$row[RideID]' name='delete' style='background-color:#9c2222c9; border:1px solid black; color:white;'> 
                                Delete </button></form>
                            </td>
                                
                        </tr>";}
                echo  "</table>";
            }

            if(isset($_POST['delete'])){
                $query = "DELETE  
                FROM
                    rides
                WHERE
                RideID ='$_POST[delete]'";
                // prepare query statement
                $stmt = $conn->prepare($query);
                // execute query
                $stmt->execute();
                if($stmt->execute() === true){
                    echo '<script>';
                    echo 'swal("Done!", "Ride sucessfully deleted!", "success").then(function() {
                        window.location = "rides.php";
                    });
                        </script>';
                        return true;  
                }else{
                    echo '<script>';
                    echo 'swal("Unable to Delete!", "Hmm...It seems this ride has been booked by a user.", "error").then(function() {
                        window.location = "rides.php";
                    });
                        </script>';
                        return false;  
                }
                    
            }
                ?>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rideaddmodal">
                    ADD RIDE
                </button>
            </div>
            </div>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="rideaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Ride </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

    <form action="insertride.php" method="POST">

        <div class="modal-body">
            <div class="form-group">
                <label> Pickup Point </label>
            
                <select class="form-control" name="pickup" required>
                    <option value="">---Select---</option>
                    <option value="Ashesi University">Ashesi University</option>
                    <option value="Accra Mall">Accra mall</option>

                </select>
            </div>

            <div class="form-group">
                <label> Destination</label>
                <select class="form-control" name="destination" required>
                    <option value="">---Select---</option>
                    <option value="Ashesi University">Ashesi University</option>
                    <option value="Accra Mall">Accra Mall</option>
                    <option value="Coca-cola Roundabout">Coca-cola Roundabout</option>
                    <option value="Spintex">Spintex</option>
                    <option value="Osu">Osu</option>

                </select>
            </div>

            <div class="form-group">
                <label> Route </label>
                <select class="form-control" name="route" required>
                    <option value="">---Select---</option>
                    <option value="Kwabenya-Atomic">Kwabenya-Atomic</option>
                    <option value="Kitase-Adenta">Kitase-Adenta</option>
                                    
                </select>
            </div>

            <div class="form-group">
                <label> Capacity </label>
                <input type="number" name="capacity" class="form-control" placeholder="Enter Shuttle Capacity">
            </div>


            <div class="form-group">
                <label> Date </label>
                <input value="<?php echo date('Y-m-d'); ?>" type="date" name="date" class="form-control" placeholder="Enter Date">
            </div>

            <div class="form-group">
                <label> Time </label>
                <input type="time" name="time" class="form-control" placeholder="Enter Time">
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="insertride" class="btn btn-primary">Add Ride</button>
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