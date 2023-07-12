	<?php
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400

<?php
include('../dbase.php');
 if(isset($_POST['submit']))
 {
 	$val = $_POST['welcome']; 
	$insertQuery = "UPDATE  welcome set models ='$val' where 1";
	$conn = mysql_query($insertQuery) or die ( mysql_error()); 
	if($conn) 
	{
		?>
		<script type="text/javascript">
		alert("The data was saved successfully.");
		</script>
		<?
	}
 }		
 
  	$welcomeQuery = "SELECT models FROM welcome"; 
	$result = mysql_query($welcomeQuery) or die(mysql_error()); 
	$chkN = mysql_num_rows($result) ; 
	if($chkN > 0 ) 
	{
		$valueW = mysql_result($result,0,'models'); 
	}
	else
	{
		$valueW = "Please write something"; 
	}

?>


<?
  include ("../dbase.php");
include ("../settings.php");
$tempMinutesPv=0;
$tempSecondsPv=0;
$sitemoney=0;
$tempMoneyEarned=0;
$tempMoneySent=0;
$tempMoneyEarned30=0;
$ammount=0;
$result = mysql_query("SELECT * FROM videosessions ");
while($row = mysql_fetch_array($result)) 
	{
	$member=$row['member'];
	$epercentage=$row['epercentage'];
	$duration=$row['duration'];
	$cpm=$row['cpm'];
	$tempSecondsPv+=$row['duration'];
	$ammount=(($duration/60)*$cpm)*$epercentage/10000 ;
	$ammount2=(($duration/60)*$cpm)*(100-$epercentage)/10000 ;
	$tempMoneyEarned+=$ammount;
	$sitemoney+=$ammount2;
	
	if(time()-604800<$row['date']){
	$tempMoneyEarned30+=$ammount;
	$sitemoney30+=$ammount2;
	}
	if ($row['paid']=="1"){ 
	$tempMoneySent+=$ammount;}
	}
mysql_free_result($result);
?>




<?



	//$secondsAll=time();
		
	

	
		$result = mysql_query("SELECT * FROM chatmodels WHERE status!='pending' AND status!='rejected'");


$total=mysql_num_rows($result);
$perpage=35;
if($_GET[page])
{
$page=$_GET[page];
}
else
{
$page=1;
}
$start=($page-1)*$perpage;
$result = mysql_query("SELECT * FROM chatmodels WHERE status!='pending' AND status!='rejected' LIMIT $start,$perpage");
if($_POST[srn])
{
$result = mysql_query("SELECT * FROM chatmodels WHERE user like '%$_POST[srn]%' OR email='$_POST[srn]' ");
}


		while($row2 = mysql_fetch_array($result)) 
			{
			$result3=mysql_query("SELECT name FROM countries WHERE id='$row2[country]' LIMIT 1");
			while($row3 = mysql_fetch_array($result3)) 
				{
				$tempCountry=$row3[name];
				}
			
			$tempCity=$row2[city];	
			
			if ($color=="#ffffff"){
			$color="#ffffff";
			}else{ $color="#ffffff";}
			echo'<tr bgcolor="'.$color.'" class="form_definitions"><td align="left"><b>'.$row2[user].'</b></td><td>'.$tempCountry.'</td><td>'.$row2[email].'</td><td align="left"><a href="modelviewdetails.php?id='.$row2[id].'">View Details</a></td></tr>';	
			}




	?>
