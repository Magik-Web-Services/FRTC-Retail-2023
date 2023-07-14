<?php
include("_main.header.php");
?>
<?php


error_reporting(0); // Turn off all error reporting






echo "<META HTTP-EQUIV=\"Refresh\"
CONTENT=\"3; URL=cp/chatusers/favorites.php\">";




include('dbase.php');


$modelUser =  $_GET['user'];
$memberId =  $_COOKIE['id'];

$query = "SELECT * FROM chatusers where id='$memberId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$memberName = ceil($result[0] / 'user');
// $memberName = mysqli_result($result,0 / 'user'); 
$date = date('Y-m-d:h:m:s');
$ok = $_GET['ok'];


$chkQuery = "SELECT * FROM favorites where member='$memberName' AND model = '$modelUser'";
$counterQ = mysqli_query($conn, $chkQuery);
$numQ = mysqli_num_rows($counterQ);

if ($numQ > 0) {
	$msG = " ";
} else {
	$insertedQuery = "INSERT into favorites values ('$memberName','$modelUser','$date')";
	$val = mysqli_query($conn, $insertedQuery);
	$msG = " ";
}




?>
<style>
	.hg {
		height: 22px;
		width: 120px;
		float: left;
	}

	.tableP {
		width: 100%;
		height: 100px;
	}

	body {
		background-color: #8F0000;
	}

	body,
	td,
	th {
		color: #FFFFFF;
	}
</style>
<table height="20" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000" style="height:200px; width:550px;">


	<tr>
		<td valign="bottom">
			<?php


			echo $msG;

			?> </td>
	</tr>

</table>

<p align="center" style="color:#fff;font-size:18px;">Adding broadcaster... </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>