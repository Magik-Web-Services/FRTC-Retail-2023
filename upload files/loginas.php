<?php
setcookie("usertype",'chatmodels',time()+360000);
setcookie("id",$_POST[id], time()+360000);
header("Location: /cp/chatmodels/");
?>