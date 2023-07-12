<?
include("dbase.php");
include("settings.php");
$model=$_GET["model"];
	$result = mysql_query("SELECT * FROM chatmodels WHERE user='$model' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
	{
		$gmt=$row['gmt'];
		if (substr($gmt,0,1)=="+"){
		$gmt="plus".substr($gmt,1);
		} else if (substr($gmt,0,1)=="-"){
		$gmt="minu".substr($gmt,1);
		}
		
		echo "&gmt=$gmt";
		echo "&monday1=". substr($row['monday'],0,2);
		echo "&monday2=". substr($row['monday'],2,2);
	
		echo "&tuesday1=". substr($row['tuesday'],0,2);
		echo "&tuesday2=". substr($row['tuesday'],2,2);
	
		echo"&wednesday1=".substr($row['wednesday'],0,2);
		echo"&wednesday2=".substr($row['wednesday'],2,2);
	
		echo"&thursday1=".substr($row['thursday'],0,2);
		echo"&thursday2=".substr($row['thursday'],2,2);
	
		echo"&friday1=".substr($row['friday'],0,2);
		echo"&friday2=".substr($row['friday'],2,2);

		echo"&sunday1=".substr($row['sunday'],0,2);
		echo"&sunday2=".substr($row['sunday'],2,2);
	
		echo"&saturday1=".substr($row['saturday'],0,2);
		echo"&saturday2=".substr($row['saturday'],2,2);
	}
?>