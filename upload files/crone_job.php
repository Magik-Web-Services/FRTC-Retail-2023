<?php
/*echo "The time is " . date("h:i:sa");*/
include("dbase.php");
include("settings.php");
mysql_query("UPDATE chatmodels SET views='0'");
mysql_query("TRUNCATE TABLE users_models_message");
?>