<?
include("dbase.php");
include("settings.php");
$model=$_GET["model"];
	$result = mysql_query("SELECT * FROM chatmodels WHERE user='$model' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
	{
		$tempEmail=$row["email"];
		echo'&L1='. str_replace(" ", "+", $row[language1]);
		echo'&L2='. str_replace(" ", "+", $row[language2]);

	$tDay=date("d",$row["birthDate"] );
	$tMonth=date("F",$row["birthDate"] );
	$tYear=date("Y",$row["birthDate"] );
	$tBirthD=$row["birthDate"];
	
		echo'&nYears='. str_replace(" ","+",date('Y',time()-$tBirthD)-1970);
		echo"&braSize=".$row["braSize"];
		echo'&birthSign='. str_replace(" ", "+", $row[birthSign]);
		echo'&message='. str_replace(" ","+",$row[message]);
		echo'&fantasies='.str_replace(" ","+",$row[fantasies]);
		echo'&position='.str_replace(" ","+",$row[position]);
		echo'&ethnicity='.str_replace(" ","+",$row[ethnicity]);
		echo'&eyeColor='.str_replace(" ","+",$row[eyeColor]);
		echo'&height='.str_replace(" ","+",$row[height]);
		echo'&weight='.str_replace(" ","+",$row[weight]);
		echo'&heightM='.str_replace(" ","+",$row[heightMeasure]);
		echo'&weightM='.str_replace(" ","+",$row[weightMeasure]);
		echo'&haircolor='.str_replace(" ","+",$row[hairColor]);
		echo'&hairlength='.str_replace(" ","+",$row[hairLength]);		
		echo'&pubichair='.str_replace(" ","+",$row[pubicHair]);
		echo'&hobbies='.str_replace(" ","+",$row[hobby]);
		echo'&location='.str_replace(" ","+",$row[broadcastplace]);	
		
	}
?>