<!-- Modal -->
<div class="modal fade" id="ridetaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Ride </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="#" method="POST">

            <div class="modal-body">
                <div class="form-group">
                    <label> Pickup Point </label>
                    <input type="text" name="pickup" class="form-control" placeholder="Enter Pickup">
                </div>

                <div class="form-group">
                    <label> Destination</label>
                    <input type="text" name="destination" class="form-control" placeholder="Enter Destination">
                </div>

                <div class="form-group">
                    <label> Route </label>
                    <input type="text" name="route" class="form-control" placeholder="Enter Route">
                </div>

                <div class="form-group">
                    <label> Date </label>
                    <input type="date" name="date" class="form-control" placeholder="Enter Date">
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

