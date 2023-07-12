
<?

include("_header-admin.php");		
	
	  
?>




<style type="text/css">
<!--





.selector
{
  background-image: url();
  background-color: #FFFFFF;
  
  position: fixed;
  
  top: 0;
  left: 0;
  width: 100%;
  height: 40px;
  z-index: 10;

}



.form_definitions{
    background-color:#ddd;
	color:#fff;
	border:solid;
	border-width:0.5px;
	border-color:#ccc;
	border-radius:4px;
	padding:8px !important;
    margin-bottom:2px;
    

}


.disconnect:hover {
    display:none;

}


.connect:hover {
    display:none;


}






-->

</style>



<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td bgcolor="#ffffff"><?
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




      <table width="1010" border="0" align="center">
        <tr align="center">
          <td>

</td>
        </tr>
 <tr align="center">
          <td>

</td>
        </tr>
      </table>
</table>
      <table width="1010"  border="0" align="center">
        <tr>
          <td width="241" class="big_title"><div align="left" style="margin-top:-50px;margin-bottom:100px;font-size:18px;font-family:Arial, Helvetica, sans-serif;font-weight:300;">
		  

          <div align="center" style="position:absolute;left:0px;top:80px;right:0px;width:100%;align-text:center;">  Online Broadcasters : <? echo $onlinemodels;?> | <a href="models.php">Registered Broadcasters: <? echo $nTotal; ?></a> |
              <a href="newsubscriptions.php">Pending Broadcasters: <? echo $nPending; ?></a> </div>
			  
			  <br>
			  
          </div>
		  
		  </td>
        </tr>
</table>


<br>
<br>


      <div align="center" style="margin-top:5px;">
        <table width="60%" border="0" style="margin-bottom:-40px;">
          <tr>
		  
		  
		  
		             <form method="post" action="<? echo $PHP_SELF ?>">
					   
					   <input type="submit" name="offline" value=" Disconnect All "  style="margin:3px;cursor:pointer;background-color:#ff0707;color:#fff;border-radius:40px;width:200px;padding:8px;"/>
					   
  <input type="submit" name="online" value=" Set All As Live " style="cursor:pointer;background-color:#d3ff02;color:#353535;border-radius:40px;width:200px;padding:8px;margin:3px;"/>
</form>	  

       <form method="post" action="<? echo $PHP_SELF ?>">
              <input type="text" name="search" value="<?=$_POST['search'];?>" style="width:200px;border-radius:40px;padding:8px;color:#939393;margin:3px;" placeholder="Enter a username... &#128269;"/>
  <input type="submit" name="submit" value="Search" style="margin:3px;background-color:#fff;width:215px;cursor:pointer;color:#717171;border-radius:40px;padding:8px;"/>
  </form>
  


</td>
            <td width="10">&nbsp;</td>
          </tr>
        </table>
        </td>
        </tr>
        </table>

		
		
        <?php
if($_POST['search'])
{
echo '<table width="60%px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td><p class="">
      <div style="font-size:20px;font-weight:300;color:#4f4f4f;">Search Results </div></p>
    </td>
  </tr>
</table>';
echo '<table width="60%px" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#ffffff">';

		    $count=0;
			$nTime=time();	
			
			$result = mysql_query("SELECT * FROM chatmodels WHERE user like '%$_POST[search]%' ");
			while($row = mysql_fetch_array($result)) 
				{			
				
				$tBirthD=$row['birthDate'];
				$nYears=date('Y',time()-$tBirthD)-1970;
				$modelid = $row['id'];	
				$username=$row['user'];
				$tempMessage=$row['message'];
				$tempCity=$row['city'];
				$tempPlace=$row['broadcastplace'];
				$tempL1=$row['language1'];
				$tempL2=$row['language2'];	
				$tempL3=$row['language3'];	
				$tempL4=$row['language4'];	

					
				$languagestring=$tempL1;
				if (strtolower($tempL2)!="none"){
				$languagestring.= ", ".$tempL2;
				}
				if (strtolower($tempL3)!="none"){
				$languagestring.= ", ".$tempL3;
				}
				if (strtolower($tempL4)!="none"){
				$languagestring.= ", ".$tempL4;
				}
			
				$count++;
				if ($count==1) {echo' <tr bgcolor="#ffffff">';}
				echo '<td width="200px" width="150px" align="center" valign="middle">';
  				echo '<table width="200px" width="150px" border="0" cellpadding="2" cellspacing="1">';
	 			echo '<tr bgcolor="#ffffff">';
				echo '<td align="center" valign="middle"><a href="../liveshowchat.php?model='.$username.'" target="_blank"><img src="../models/'.$username.'/thumbnail.jpg" width="200px" width="150px" border="0"></a></td>';			
				echo '</tr><tr bgcolor="#ffffff">';
		      	echo '<td align="center" valign="top">';
				echo '<span class="model_title">'.$username.'</span><br>';
				echo '<div class="" style="background-color:#ff0000;padding:5px;border:solid;border-width:0.5px;border-color:#eee;border-radius:4px;margin-top:5px;color:fff;"><a href="makeOnline.php?model='.$modelid.'" style="color:#fff;"><a href="makeOffline.php?model='.$modelid.'" style="color:#fff;">  Disconnect </a></div><br>';
		     	
		        //echo '<span class="model_title_small">, '.$nYears.' years from '.$tempPlace.', speaks: '.$languagestring.'</span><br>';
		        //echo '<span class="model_message">'.$tempMessage.'</span></td>';
				echo '</tr></table>';
				echo '  </td>';
				if ($count==4){ echo"</tr>"; $count=0;}
				}
			

			if ($count==1){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			} else if ($count==2){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			} else if ($count==3){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			}
			
			mysql_free_result($result);
			echo'</table>';
}
 			?>
      </div>

<?php 

if($_GET[show]!='off')
{
if (!isset($_GET['category']))
			{
			$select="SELECT * FROM chatmodels WHERE status='online' LIMIT $start,$perpage";//100hours
			} else{
			$select="SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='online' LIMIT $start,$perpage";
			}
						
			
			$result = mysql_query($select);

$total=mysql_num_rows(mysql_query("SELECT * FROM chatmodels WHERE status='online'"));

echo '<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:0px;margin-top:5px;">
  <tr>
    <td><p class="" style="font-size:20px;font-family:arial;font-weight:300;"><br />
      Online Broadcasters <span class="style4"></span></p>
    </td><td align="right">Pages ';
$pages=range(1,ceil($total/$perpage));

foreach($pages as $pagez)
{
if($page==$pagez)
{
echo "<b>$pagez</b> ";
}
else
{
echo "<a href=\"index.php?show=on&page=$pagez\">$pagez</a> ";
}
}

echo '</td></tr>
</table>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">    
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eee">';

		    $count=0;
			$nTime=time();
			
			
			
			while($row = mysql_fetch_array($result)) 
				{			
				
				$tBirthD=$row[birthDate];
				$nYears=date('Y',time()-$tBirthD)-1970;
				$modelid = $row[id];	
				$username=$row[user];
				$tempMessage=$row[message];
				$tempCity=$row[city];
				$tempPlace=$row[broadcastplace];
				$tempL1=$row[language1];
				$tempL2=$row[language2];	
				$tempL3=$row[language3];	
				$tempL4=$row[language4];	

					
				$languagestring=$tempL1;
				if (strtolower($tempL2)!="none"){
				$languagestring.= ", ".$tempL2;
				}
				if (strtolower($tempL3)!="none"){
				$languagestring.= ", ".$tempL3;
				}
				if (strtolower($tempL4)!="none"){
				$languagestring.= ", ".$tempL4;
				}
			
				$count++;
				if ($count==1) {echo' <tr bgcolor="#fff">';}
				echo '<td width="200 width="150px" align="center" valign="middle">';
  				echo '<table width="200px" width="150px" border="0" cellpadding="2" cellspacing="1">';
	 			echo '<tr bgcolor="#ffffff">';
				echo '<td align="center" valign="middle"><a href="../liveshowchat.php?model='.$username.'" target="_blank"><img src="../models/'.$username.'/thumbnail.jpg" width="200px" width="150px" border="0"></a></td>';			
				echo '</tr><tr bgcolor="#ffffff">';
		      	echo '<td align="center" valign="top">';
				echo '<span class="model_title">'.$username.'</span><br>';
				echo '<div class="" style="background-color:#ff0000;padding:5px;border:solid;border-width:0.5px;border-color:#eee;border-radius:4px;margin-top:5px;color:fff;"><a href="makeOnline.php?model='.$modelid.'" style="color:#fff;"><a href="makeOffline.php?model='.$modelid.'" style="color:#fff;">  Disconnect </a></div><br>';
		     	
				
				
				
				
				
				
				
				
				
				
				
		        //echo '<span class="model_title_small">, '.$nYears.' years from '.$tempPlace.', speaks: '.$languagestring.'</span><br>';
		        //echo '<span class="model_message">'.$tempMessage.'</span></td>';
				echo '</tr></table>';
				echo '  </td>';
				if ($count==5){ echo"</tr>"; $count=0;}
				}
			

			if ($count==1){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			} else if ($count==2){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			} else if ($count==3){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			} else if ($count==4){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			}
			
			mysql_free_result($result);
			echo'</table></td></tr></table>';
}
?>
<?php

if($_GET[show]!='on')
{
if (!isset($_GET['category']))
			{
			$select="SELECT * FROM chatmodels WHERE status='offline' LIMIT $start,$perpage";//100hours
			} else{
			$select="SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='offline' LIMIT $start,$perpage";
			}
						
			
			$result = mysql_query($select);
$total=mysql_num_rows(mysql_query("SELECT * FROM chatmodels WHERE status='offline'"));

echo '<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="" style="font-size:20px;font-family:arial;font-weight:300;"><br />
    Offline Broadcasters <span class="style4"></span>
	</td><td align="right">Pages ';

$pages=range(1,ceil($total/$perpage));

foreach($pages as $pagez)
{
if($page==$pagez)
{
echo "<b>$pagez</b> ";
}
else
{
echo "<a href=\"index.php?show=off&page=$pagez\">$pagez</a> ";
}
}

echo '</td></tr>
</table>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eee">';
		    $count=0;
			$nTime=time();
			
			while($row = mysql_fetch_array($result)) 
				{			
				$tBirthD=$row['birthDate'];
				$nYears=date('Y',time()-$tBirthD)-1970;
				$modelid = $row['id'];	
				$tempMessage=$row['message'];
				$username=$row['user'];
				$tempCity=$row['city'];
				$tempPlace=$row['broadcastplace'];
				$tempL1=$row['language1'];
				$tempL2=$row['language2'];	
				$tempL3=$row['language3'];	
				$tempL4=$row['language4'];	
						
				$languagestring=$tempL1;
				if (strtolower($tempL2)!="none"){
				$languagestring.= ", ".$tempL2;
				}
				if (strtolower($tempL3)!="none"){
				$languagestring.= ", ".$tempL3;
				}
				if (strtolower($tempL4)!="none"){
				$languagestring.= ", ".$tempL4;
				}
				

				$count++;
				if ($count==1) {echo' <tr bgcolor="#ffffff">';}
				echo '<td width="200px" width="150px" align="center" valign="middle">';
  				echo '<table width="200px" width="150px" border="0" cellpadding="2" cellspacing="1">';
	 			echo '<tr bgcolor="#ffffff">';
				
		 		echo '<td align="center" valign="middle"><a href="../liveshowchat.php?model='.$username.'" target="_blank"><img src="../models/'.$username.'/thumbnail.jpg" width="200px" width="150px" border="0" style="opacity:0.5;"></a></td>';
				echo '</tr><tr bgcolor="#ffffff">';
		      	echo '<td align="center" valign="top">';
				echo '<span class="model_title">'.$username .'</span><br>';
				echo '<div class="" style="background-color:#7aab00;padding:5px;border:solid;border-width:0.5px;border-color:#eee;border-radius:4px;margin-top:5px;color:fff;a:color#fff;"><a href="makeOnline.php?model='.$modelid.'" style="color:#fff;">Make Live </a></div><br>';
		     	
		        //echo '<span class="model_title_small">, '.$nYears.' years from '.$tempPlace.', speaks: '.$languagestring.'</span><br>';
		        //echo '<span class="model_message">'.$tempMessage.'</span></td>';
				echo '</tr></table>';
				echo '  </td>';
				if ($count==5){ echo"</tr>"; $count=0;}
				}
			

            if ($count==1){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			} else if ($count==2){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			} else if ($count==3){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			} else if ($count==4){
			echo'<td width="240"  height="120" align="center" valign="middle">&nbsp</td>';
			echo'</tr>';
			}
			
			mysql_free_result($result);
			echo'</table></td></tr></table>';
}
?>


<div align="center">
  <table width="1010" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="left">
       
      </div></td>
    </tr>
  </table>
</div>








<table width="1010"  border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>

<?
include("_footer-admin.php")
?>