<?php
/*echo "The time is " . date("h:i:sa");*/
include("dbase.php");
include("settings.php");
mysqli_query($conn, "UPDATE chatmodels SET views='0'");
mysqli_query($conn, "TRUNCATE TABLE users_models_message");
?>