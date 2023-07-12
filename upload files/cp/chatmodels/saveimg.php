


<?php 

if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatmodels" )

{

header("location: ../../login.php");

} else{

include("../../dbase.php");

$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");



	while($row = mysql_fetch_array($result)) 

	{	$username=$row[user];	}

$urlThumbnail="../../models/".$username."/thumbnail.jpg";

if(getimagesize($_FILES['webcam']['tmp_name'])!==false)
{
move_uploaded_file($_FILES['webcam']['tmp_name'], $urlThumbnail);    
}
    
}

?>