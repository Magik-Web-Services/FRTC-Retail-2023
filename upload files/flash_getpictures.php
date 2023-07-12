<? 
//connection to the database
include("dbase.php");
include("settings.php");

//echo $displayId;
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo'<IMAGES>';
$query="SELECT * from modelpictures WHERE user='$_GET[model]'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
						$name=$row["name"];
echo'<media mt="image" nm="'.$name.'"/>';
}//endwhile
echo'</IMAGES>';


?>