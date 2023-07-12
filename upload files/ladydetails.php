<head>

<script type="text/javascript" src="slideshow.js"></script>

<script type="text/javascript" src="js/lightbox.js"></script>

<?

#
function GetAge($Birthdate)
#
{
#
        // Explode the date into meaningful variables
#
        list($BirthDay,$BirthMonth,$BirthYear) = explode("/", $Birthdate);
#
        // Find the differences
#
        $YearDiff = date("Y") - $BirthYear;
#
        $MonthDiff = date("m") - $BirthMonth;
#
        $DayDiff = date("d") - $BirthDay;
#
        // If the birthday has not occured this year
#
        if ($DayDiff < 0 || $MonthDiff < 0)
#
          $YearDiff--;
#
        return $YearDiff;
#
}
?>


<? if (isset($_COOKIE["usertype"])){

	
    include("_main.header.logged.in.php");	
	
			  	  

	} else {
 
		 
	include("_main.header.php");		  
			  

	}?>













<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #E9E9E9;
}
body {
	background-color: #8F0000;
	margin-left: 0px;
	margin-right: 0px;
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



-->
</style>
<?
if(isset($_POST['epc']) && isset($_POST['cpm'])){
include('dbase.php');
include('settings.php');
mysql_query("UPDATE chatmodels SET cpm='$_POST[cpm]',epercentage='$_POST[epc]' WHERE id = '$_POST[id]' LIMIT 1");

}
?>
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
                $tBirthD= GetAge($row["birthDate"]);
             //   echo $row["birthDate"];
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
	
	
<!--Start Layout-->



	
		

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

<div align="center">
  <table width="1000" height="60" border="0" cellpadding="0" background="images/ladydetails-top-bar.png">

  </table>
  <table width="1000" height="62" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="410" background="images/ladydetails-top-bar.png"><div align="center">
        <h2 align="left">&nbsp;&nbsp;&nbsp;&nbsp;<? echo $tempUser ?>'s Profile</h2>
      </div></td>
      <td width="192" background="images/ladydetails-top-bar.png"><div class="hoverbox" align="center"><a href="liveshow.php?model=<? echo $tempUser ?>"><img src="images/live-chat-button.png" alt="LIVE CHAT" width="192" height="44" border="0" /></a></div></td>
      <td width="192" background="images/ladydetails-top-bar.png"><div class="hoverbox" align="center"><a href="videos.php?model=<? echo $tempUser ?>"><img src="images/my-videos-button.png" alt="MY VIDEOS" width="192" height="44" border="0" /></a></div></td>
      <td width="206" background="images/ladydetails-top-bar.png"><div class="hoverbox" align="left"><a href="addfavourite.php?user=<? echo $tempUser ?>&ok=ok"><img src="images/make-favorite-button.png" alt="ADD AS FAVORITE" width="192" height="44" border="0" /></a></div></td>
    </tr>
  </table>
  <table width="1000" border="0" cellpadding="0">
    <tr>
      <td width="265"><div class="hoverbox" align="left"><a href="liveshow.php?model=<? echo $tempUser ?>"><img src="../models/<? echo $tempUser."/thumbnail.jpg" ?>" alt="Performer thumbnail image" width="250" height="200" border="0" /></a></div></td>
      
      <td width="725" valign="top"><table width="725" border="0" cellpadding="0">
        <tr>
          <td width="64"><b><? echo $tBirthD; ?></b></td>
          <td width="131"><b><? echo $tL3; ?></b></td>
          <td width="124"><b><? echo $tL1; ?></b></td>
		  <td width="108"><b><? echo $tEthnic; ?></b></td>
          <td width="111"><b><? echo $tWeight." ".$tWeightM; ?></b></td>
           <td width="175"><b><? echo $tHeight." ".$tHeightM; ?></b></td>
        </tr>
      </table>
        <h3><? echo $tMessage;?></h3></p></td>
    </tr>
  </table>
      <table width="1000" height="62" border="0" cellpadding="0">
        <tr>
          <td background="images/ladydetails-top-bar.png"><div align="center">
            <h2><? echo $tempUser; ?>'s &nbsp;Photo Gallery </h2>
          </div></td>
        </tr>
  </table>
      <table id="hoverbox" width="1000" border="0" cellpadding="0" bordercolor="#000000">
        <tr>
          <td><div class="hoverbox" align="center">
           
            <?

		    $count=0;

			$result = mysql_query('SELECT * FROM modelpictures WHERE user="'.$tempUser.'" ORDER BY dateuploaded DESC');

			while($row = mysql_fetch_array($result)) 

			{

			$count++;

			if ($count==1) {echo"<tr>";}


			echo "<td width='200' height='150' align='left' valign='middle'><div class='hoverbox'><a href='models/".$tempUser."/".$row['name'].".jpg' rel='lightbox[model]'><img src ='models/".$tempUser."/".$row['name']."_thumbnail.jpg' border='0'></a></div></td>";
				

			if ($count==5){ echo"</tr>"; $count=0;}

			}

			mysql_free_result($result);

			for($i=0; $i<5-$count; $i++)

			{

			//echo "<td width='200' height='150' align='left' valign='middle'>&nbsp</td>";

			}

			echo "</tr>";

 			?>
          </div></td>
        </tr>
  </table>
</div>




<?
include("_main.footer.php");
?>
      
<map name="Map" id="Map">
<area shape="rect" coords="14,12,179,50" href="#" />
</map>
<map name="Map2" id="Map2">
<area shape="rect" coords="13,12,180,51" href="#" />
</map>