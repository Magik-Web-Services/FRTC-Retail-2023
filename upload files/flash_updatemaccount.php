<?
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

$result=mysql_query("SELECT owner,epercentage from chatmodels WHERE user='$model' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
		{	$epercentage=$row['epercentage'];	
			$owner=$row['owner'];
		}
if ($type=="show"){
	$result=mysql_query("SELECT sessionid from videosessions WHERE sessionid='$sessionid' LIMIT 1");
	if (mysql_num_rows($result)!=1){
		mysql_query("INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','$type')");
		mysql_query("INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','$type')");
		}else{
		mysql_query("UPDATE videosessions SET duration=duration+'60' WHERE sessionid='$sessionid' LIMIT 1");
		mysql_query("UPDATE videosessions_copy SET duration=duration+'60' WHERE sessionid='$sessionid' LIMIT 1");
		}
	mysql_query("UPDATE chatusers SET money=money-'$ammount2' WHERE user = '$member' LIMIT 1");
} else if( $type=="tip"){
	mysql_query("INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','tip')");
	mysql_query("INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','tip')");
	mysql_query("UPDATE chatusers SET money=money-'$ammount' WHERE user = '$member' LIMIT 1");
} else if ($type=="movie"){
	mysql_query("INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','movie')");
	mysql_query("INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('$sessionid','$member', '$model', '$owner', '$ammount','$epercentage', '$now', '60','0','0','movie')");
	mysql_query("UPDATE chatusers SET money=money-'$ammount' WHERE user = '$member' LIMIT 1");
}
?>