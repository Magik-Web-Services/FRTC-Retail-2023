<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php
	include("dbase.php");
	include("settings.php");
	$nTime = time();
	mysqli_query($conn, "UPDATE chatmodels SET status='offline' WHERE $nTime-lastupdate>30 AND status!='rejected' AND status!='blocked' AND status!='pending' AND forcedOnline='0'");
	?>
	<?php
	$query = mysqli_query($conn, "select * from category order by name asc");
	while ($row = mysqli_fetch_object($query)) {
		$cats[] = $row->name;
	}
	$cat_array = array_chunk($cats, 1000);
	$columns = count($cat_array);
	?>
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAADgAP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIhEiIiIiIiIhERIiIiIiIhERESIiIiIhESIREiIiIhEQIgERIiIhEQAiIBESIhEQIiIiAREhESIiIiIiERESIiIiIiIhERIiIhEiIiEREiIhERIiIRERIhERESIREhERESIREREiIREQIgEREiAAAAAAAAAAD//wAA/n8AAPw/AAD4HwAA8Y8AAOPHAADH4wAAj/EAAB/4AAA//AAAPnwAADw8AAAYGAAAgYEAAMPDAAD//wAA" rel="icon" type="image/x-icon" />
	<title><?php echo $sitename; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="styles.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}

		.hamburger {
			width: 38px;
			height: 38px;
			background-color: #990000;
			color: FFF;
			border-bottom-style: solid;
			border-bottom-color: #000000;
		}
	</style>
</head>

<body>
	<table width="100%" cellpadding="5" cellspacing="0" bgcolor="#BB0004">
		<tr>
			<td height="44"><a href="cat-page.php"><img src="hamburger.png" alt="options tab" width="38" height="38" border="0" /></a></td>
		</tr>
	</table>