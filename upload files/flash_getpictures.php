<?php 
//connection to the database
include("dbase.php");
include("settings.php");

//echo $displayId;
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo'<IMAGES>';
$query="SELECT * from modelpictures WHERE user='$_GET[model]'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
						$name=$row["name"];
echo'<media mt="image" nm="'.$name.'"/>';
}//endwhile
echo'</IMAGES>';


?>