<?php
include("dbase.php");
include("settings.php");

$type=$_POST['ptype'];
$ammount=$_POST['cpm'];
$ammount2=ceil($ammount);
$member=$_POST['member'];
$model=$_POST['model'];
$now=time();
if ($_POST['sessionstring']==""){
	$sessionid=md5($member.$model.$now);
} else {
	$sessionid=md5($_POST['sessionstring']);
}

$result=mysqli_query($conn, "SELECT owner,epercentage from chatmodels WHERE user='$model' LIMIT 1");
	while($row = mysqli_fetch_array($result)) 
		{	$epercentage=$row['epercentage'];	
			$owner=$row['owner'];
		}
if ($type=="show"){
	$result=mysqli_query($conn, "SELECT sessionid from videosessions WHERE sessionid='$sessionid' LIMIT 1");
	if (mysqli_num_rows($result)!=1){
		mysqli_query($conn, "INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','$type')");
		mysqli_query($conn, "INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','$type')");
		}else{
		mysqli_query($conn, "UPDATE videosessions SET duration=duration+'60' WHERE sessionid='$sessionid' LIMIT 1");
		mysqli_query($conn, "UPDATE videosessions_copy SET duration=duration+'60' WHERE sessionid='$sessionid' LIMIT 1");
		}
	mysqli_query($conn, "UPDATE chatusers SET money=money-'$ammount2' WHERE user = '$member' LIMIT 1");
} else if( $type=="tip"){
	mysqli_query($conn, "INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','tip')");
	mysqli_query($conn, "INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','tip')");
	mysqli_query($conn, "UPDATE chatusers SET money=money-'$ammount' WHERE user = '$member' LIMIT 1");
} else if ($type=="movie"){
	mysqli_query($conn, "INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','movie')");
	mysqli_query($conn, "INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','movie')");
	mysqli_query($conn, "UPDATE chatusers SET money=money-'$ammount' WHERE user = '$member' LIMIT 1");
}
?>