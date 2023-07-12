<?php
include('../../dbase.php');
    $sql2="select * from payccbill where code='1'";
    $res2=mysql_query($sql2);
    $row2=mysql_fetch_object($res2);

$salt=$row2->codtxt;

$username=$_POST['username1'];
$subscription_id=$_POST['subscription_id'];
$amt=$_POST['initialPrice'];


if($_POST['responseDigest']==md5($subscription_id.'1'.$salt))
{
$row=mysql_fetch_object(mysql_query("select * from package where price='$amt' "));
$amount=$row->tokens;
mysql_query("update chatusers set money=money+'$amount' where user='$username'  ");
mysql_query("insert into payments (id,ammount,method,details,date) values ('$subscription_id','$amt','ccbill','$username',UNIX_TIMESTAMP())");
}


?>