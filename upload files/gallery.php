<?
include("_main.header.php");
?>
<style type="text/css">
<script type="text/javascript" src="slideshow.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<!--
.style3 {font-size: 10px}
-->
</style>
<?
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		
	include('dbase.php');
	
	
	$result = mysql_query("SELECT * FROM chatmodels WHERE user='$_GET[user]' LIMIT 1");
		while($row = mysql_fetch_array($result)) 
		{
		$tempUser=$row["user"];
		$tempPass1=$row["password"];
		$tempPass2=$row["password"];
		$tempEmail=$row["email"];
		$status=$row['status'];
		$tL1=$row["language1"];
		$tL2=$row["language2"];
		$tL3=$row["language3"];
		$tL4=$row["language4"];
		
		$tBirthD=$row["birthDate"];
		$tBraS=$row["braSize"];
		$tBirthS=$row["birthSign"];
		$tMessage=$row["message"];
		$tFantasies=$row["fantasies"];
		$tPosition=$row["position"];
		$tEthnic=$row["ethnicity"];
		$tEyeC=$row["eyeColor"];
		$tHeight=$row["height"];
		$tWeight=$row["weight"];
		$tHeightM=$row["heightMeasure"];
		$tWeightM=$row["weightMeasure"];
		
		$cpm=$row["cpm"];
		$epc=$row["epercentage"];
		$tCategory=$row["category"];
		$rowdate=$row["dateRegistered"];
		$date=date("d F Y,H:i",$rowdate);
		
		$tempName = $row["name"];
		
		$result3=mysql_query("SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
			while($row3 = mysql_fetch_array($result3)) {
			$tempCountry=$row3[name];
			}
		
		$tempState=$row["state"];
		$tempZip = $row["zip"];
		$tempCity=$row["city"];
		$tempAdress = $row["adress"];
		$tempPMethod=$row["pMethod"];
		$tempPInfo=$row["pInfo"];
		$tOwner=$row['owner'];
		$tempIdmonth=$row['idmonth'];
		$tempIdyear=$row['idyear'];
		$tempIdtype=$row['idtype'];
		$tempIdnumber=$row[idnumber];
		$tempSs=$row[ssnumber];
		$tempPhone=$row[phone];
		$tempBirth=$row[birthplace];
		$tempYahoo=$row[yahoo];	
		$tempMsn=$row[msn];	
		$tempIcq=$row[icq];	
		
		$tHcolor=$row[hairColor];
		$tHlength=$row[hairLength];
		$tPhair=$row[pubicHair];	
		$tBfrom=$row[broadcastplace];
		$tHobbies=$row[hobby];
		$tempFax=$row[fax];	
		

		}
	?>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<style type="text/css">
<!--
body {
	background-color: #8F0000;
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: none;
	color: #FFCC00;
}
a:active {
	text-decoration: none;
	color: #FFCC00;
}
a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style><table width="720" height="400" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000">

  <tr>

    <td align="center" valign="middle"><p>&nbsp;</p>
      <p><strong><? echo $tempUser; ?></strong><strong>'s Picture Gallery</strong><br />
          <span class="style3">(click on the thumbnail to open the full size image)</span> </p>
      <table width="520" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?

		    $count=0;

			$result = mysql_query('SELECT * FROM modelpictures WHERE user="'.$tempUser.'" ORDER BY dateuploaded DESC');

			while($row = mysql_fetch_array($result)) 

			{

			$count++;

			if ($count==1) {echo"<tr>";}

			echo "<td width='100'class='form_definitions' height='100' align='center' valign='middle'><a href='models/".$tempUser."/".$row['name'].".jpg' rel='lightbox[model]'><img src ='models/".$tempUser."/".$row['name']."_thumbnail.jpg' border='0'></a></td>";

			if ($count==6){ echo"</tr>"; $count=0;}

			}

			mysql_free_result($result);

			for($i=0; $i<6-$count; $i++)

			{

			echo"<td width='100' height='100' align='center' valign='middle'>&nbsp</td>";

			}

			echo"</tr>";

 			?>
          </td>
        </tr>
      </table>
      <p><a href="javascript:history.go(-1)">back</a></p></td>
  </tr>

</table>
<?
include("_main.footer.php");
?>