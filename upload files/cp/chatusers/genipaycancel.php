<?php session_start();

 echo 'Order Cancelled';
 foreach($_REQUEST as $key=>$val)
 {
  echo $key . ':' . $val .'<br />';
 }
?>