<?php 
//connection to the database
include("dbase.php");
//echo $displayId;
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo'<SHOWS>';
$query="SELECT * from modelshows WHERE user='$_GET[model]'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
						$name=$row['name'];
						$string=$row['string'];
						$previewtime=$row['previewtime'];
						$movietime=$row['movietime'];
						$price=$row['price'];
echo'<media mt="show" nm="'.$name.'" string="'.$string.'" price="'.$price.'" pvt="'.$previewtime.'" mvt="'.$movietime.'"/>';
}//endwhile
echo'</SHOWS>';


?>