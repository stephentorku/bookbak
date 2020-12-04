<?php

//Retrieve the existing unique session key
session_start();

//unset them so that they are now empty
session_unset();

//destroy the unique key and erase all data on the of the user so it cannot be traced
session_destroy();

header("Location:index.php");

?>