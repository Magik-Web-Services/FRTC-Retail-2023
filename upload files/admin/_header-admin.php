<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Panel</title>


<script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</script>


<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: 300;
	color:#555;
}
body {
	background-color: #FFFFFF;
	margin-left:0px;
	margin-right:0px;
	margin-top:0px;
	margin-bottom:0px;
}


input{
    background-color:#fff;
	font-size:18px;
	color:#242323;
	border:solid;
	border-width:0.5px;
	border-color:#d0cccc;
	border-radius:4px;
	padding:5px;
    align:center;
    width:100%;

}



a:link {
	color: #626161;
	text-decoration: none;
}
a:visited {
	color: #626161;
	text-decoration: none;
}
a:hover {
	color: #626161;
	text-decoration: none;
}
a:active {
	color: #626161;
	text-decoration: none;
}





 .links{
	margin:2px;
	cursor:pointer;
    border-radius:0px;
	background-image: linear-gradient(#fff, #f0efef);
	color:#6f6d6d;
	font-weight:300;
	display: no-wrap;
	text-decoration: none;
	

}





.links:hover{
	margin:2px;
    cursor:pointer;
/*	background-image: linear-gradient(#e8f7ff, #d3e6ff); */
  /*  background-image: linear-gradient(#d2d2d2, #d7d7d7); */
/*	background-image: linear-gradient(#d3ff00, #dfff00); */
    background-image: linear-gradient(#cef900, #b8d200);
	
	
}



td{
   height:20px !important;
   
}


.new{

	margin-top:-35px;
	margin-left:115px;
    background-color:#FF2A2A;;
	color:#fff !important;
    padding:1px;
	border-radius:50%;
    width:20px;

	
}





-->
</style>
</head>

<body>



<?
$nTime=time();
$onlinemodels=0;
$onlinemembers=0;
include('../dbase.php');
include('../settings.php');

if($_POST['offline'])
{
mysql_query("UPDATE chatmodels SET status='offline',forcedOnline='0' WHERE status!='rejected' AND status!='blocked' AND status!='pending' ");
}
if($_POST['online'])
{
mysql_query("UPDATE chatmodels SET status='online',forcedOnline='1' WHERE status!='rejected' AND status!='blocked' AND status!='pending'");
}
mysql_query("UPDATE chatmodels SET status='offline' WHERE $nTime-lastupdate>30 AND status!='rejected' AND status!='blocked' AND status!='pending' AND forcedOnline !=1");  
$result=mysql_query("SELECT onlinemembers FROM chatmodels WHERE status='online'");
while($row = mysql_fetch_array($result)) 
	{
	$onlinemembers+=$row['onlinemembers'];
	}
$onlinemodels=mysql_num_rows($result);

?>


 <?php

$perpage=36;

if($_GET[page])
{
$page=$_GET[page];
}
else
{
$page=1;
}
$start=($page-1)*$perpage;

	$nTotal=0;
	$nThisMonth=0;
	$nPending=0;
	$nBoys=0;
	$nLesbian=0;
	$nCouple=0;
	$nGirls=0;
	$nTransgender=0;
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		

	
	$result = mysql_query("SELECT dateRegistered FROM chatmodels"); 
	while($row = mysql_fetch_array($result)) 
	{
	if (date( "m",$row['dateRegistered'])==date("m")){
	$nThisMonth++;	
	}
	}
	
	
	
	$result = mysql_query("SELECT * FROM chatmodels");
	while($row = mysql_fetch_array($result)) 
	{	
	if ($row['status']=="pending")
	{
	$nPending++;
	} else
	if ($row['status']!="pending" && $row['status']!="rejected")
	{
	$nTotal++;
	}
	
	switch ($row[category])
	{
	case "girls":
  		if ($row['status']!="pending") $nGirls++;
  		break;  
	case "boys":
		if ($row['status']!="pending") $nBoys++;
		break;
  	case "lesbian":
		if ($row['status']!="pending") $nLesbian++;
		break;
	case "couple":
		if ($row['status']!="pending") $nCouple++;
		break;
	case "transgender":
		if ($row['status']!="pending") $nTransgender++;
		break;
	}	
	
	}
	
	
	?>







<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">




<div align="center" style="background-color:#dfdfdf;margin:0px;position:fixed;width:100%;z-index:9999;">
  <table width="80%" border="0" cellpadding="2">

    <tr>
      <td class="links" align="center"><a href ="index.php"><i class="fas fa-gavel"></i> Admin</a></td>
	  
      <td class="links" align="center" style="padding-right:20px !important;"><p><a href="newsubscriptions.php"><i class="fas fa-address-card"></i> Pending <div class="new"><b style="color:#fff !important;"><? echo $nPending; ?></b></div></a></p></td>
	  
      <td class="links" align="center"><a href="payments.php"><i class="fas fa-dollar-sign"></i> Payouts</a></td>
	  
      <td class="links" align="center"><a href="members.php"><i class="fas fa-users-cog"></i> Members</a></td>
	  
      <td class="links" align="center"><a href="models.php"><i class="fas fa-video"></i> Broadcasters</a></td>
	  
      <td class="links" align="center"><a href="configureccbill.php"><i class="far fa-credit-card"></i> Billing API</a></td>
	  
      <td class="links" align="center"><a href="package.php"><i class="fas fa-coins"></i> Tokens</a></td>
	  
      <td class="links" align="center"><a href="categories.php"><i class="far fa-comments"></i> Categories</a></td>
	  
      <td class="links" align="center"><a href="newsletter.php"><i class="fas fa-bullhorn"></i> Mailer</a></td>
	  
	  <td class="links" align="center"><a href="logos.php"><i class="fas fa-signature"></i> Logos</a></td>
	  
      <td class="links" align="center"><a href="../"><i class="fas fa-at"></i> Site</a></td>
    </tr>

  </table>
</div>
</body>
</html>


