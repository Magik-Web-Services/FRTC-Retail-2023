<?php

include("_header-admin.php")

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
-->
.edittt-state {
    text-align: center;
    margin-bottom: 10px;
}
.edittt-state a{
    align-items: flex-start;
    text-align: center;
    cursor: default;
    color: buttontext;
    background-color: buttonface;
    box-sizing: border-box;
    padding: 2px 6px 3px;
    border-width: 2px;
    border-style: outset;
    border-color: buttonface;
    border-image: initial;
	    font-weight: normal;
		    cursor: pointer;
}





.form_definitions{
    background-color:#ddd;
	color:#fff;
	border:solid;
	border-width:0.5px;
	border-color:#ccc;
	border-radius:4px;
    margin-bottom:2px;


}







.pageNumbers{
    border:solid;
	border-width:0.5px;
	border-color:#CCCCCC;
	background-color:#3399FF;
	border-radius:4px;
	width:20px;
	height:20px;
	padding:5px;
	color:#fff;
	text-align:center;
	cursor:pointer;
    white-space:nowrap;
	display: inline-block;
}


.pageNumbers:hover{
    border:solid;
	border-width:0.5px;
	border-color:#CCCCCC;
	background-color:#99CC00;
	border-radius:4px;
	width:20px;
	height:20px;
	padding:5px;
	color:#fff;
	text-align:center;
    cursor:pointer;
}

body{
    margin-top:0px !important;



}



</style>

<?php
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		
	include('../dbase.php');
	if(isset($_POST['Submit3232'])){ 
	mysql_query("delete FROM user_logged_in where user='".$_POST['username']."' AND logged_in='yes'");	
	$sql=mysql_query("UPDATE chatusers set forced_logout='yes' where user='".$_POST['username']."'");
	$msg ="<b style='color:#ff4d07;background-color:#ddd;padding:5px;border-radius:4px;'>Member logged out.</b>";
	}
	
	
	$result = mysql_query("SELECT * FROM chatusers WHERE id='$_GET[id]' LIMIT 1");
		while($row = mysql_fetch_array($result)) 
		{
		$tempId=$row["id"];
		$tempUser=$row["user"];
		$tempEmail=$row["email"];
		$tBirthD=$row["birthDate"];
		$tempPhone=$row["phone"];
		$tempName = $row["name"];
		$status=$row['status'];
		$result3=mysql_query("SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
			while($row3 = mysql_fetch_array($result3)) {
			$tempCountry=$row3[name];
			}
		
		$tempState=$row["state"];
		$tempZip = $row["zip"];
		$tempCity=$row["city"];
		$tempAdress = $row["adress"];
		$tempDReg=$row["dateRegistered"];
		$tempMoney=$row['money'];
		
		$rowdate=$row["dateRegistered"];
		$date=date("d F Y, H:i",$rawdate);
		}
		

?>



<div align="center">
  <table width="1010" border="0" cellpadding="">
    <tr>
      <td>
	  
	    <p>&nbsp;</p>
        <p>&nbsp;</p>
		
        <div align="center"><div align="center">
  <table width="1010" height="70">
    <tr>
	
      <td><div align="left"><h1><?php echo $tempName ?></h1></div></td>
    </tr>
  </table>
</div></div></td>
    </tr>
  </table>
</div>

<table width="1190" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
	
    <td width="1188" bgcolor="#ffffff">
      
      <table width="1010" height="102" align="center" cellpadding="10" bgcolor="#FFF" class="form_def">
	  <?php if($msg!=''){ ?>
	<tr><td><?php echo $msg; ?></td></tr>
	<?php } ?>
      <tr>
        <td width="342" valign="bottom"><p><strong class="big_title">Account Holder:&nbsp; <?php echo $tempName ?></strong><br />
        <strong>Account Status: &nbsp;<?php echo $status;?></strong><br />
        </p>
          <table width="496" align="center" cellpadding="1" class="form_def">
            <tr>
              <td width="107" align="left">User Name:</td>
              <td width="93"><?php echo $tempUser; ?></td>
              <td width="10">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">Email:</td>
              <td><?php echo $tempEmail; ?></td>
              <td >&nbsp;</td>
            </tr>

            <tr>
              <td align="left">Full Name: </td>
              <td><?php echo $tempName; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="left">Country:</td>
              <td><?php echo $tempCountry; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="left">State:</td>
              <td><?php echo $tempState; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="left">City:</td>
              <td><?php echo $tempCity; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="left">Zip Code:</td>
              <td><?php echo $tempZip; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="left">Date Registered: </td>
              <td><?php echo date("d F Y",$tempDReg); ?></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          
          </td>
        <td width="490" valign="middle"><table width="300" height="96"  align="center" cellpadding="5px" cellspacing="">
            <tr align="center">
              <form name="form1" method="post" action="deleteaccount.php">
                <td height="30">
                  <input type="submit" name="Submit22" value="Close Account" style="background-color:#ddd !important;cursor:pointer;margin-bottom:-6px;">
                  <input name="id" type="hidden" id="id5" value="<?php echo $_GET['id']; ?>">
                  <input name="type" type="hidden" id="type4" value="member">
                  <input name="username" type="hidden" id="type5" value="<?php echo $tempUser; ?>">
                  <input name="date" type="hidden" id="datds" value="<?php echo $date; ?>"></td>
              </form>
			  
			  
            </tr>
			
			
			
			
            <tr>
<?php if($status!='blocked'){ 
	echo ' <form name="form2" method="post" action="blockaccount.php">';
} else {
	echo ' <form name="form2" method="post" action="activateaccount.php">';
}
?> 
			 
                <td height="30" align="center">
                  <input type="submit" name="Submit22" value="<?php if($status!='blocked'){echo 'Block Account ';} else {echo 'Activate Account';}?> " style="background-color:#ddd !important;cursor:pointer;margin-bottom:-6px;">
                  <input name="id" type="hidden" id="id35" value="<?php echo $_GET['id']; ?>">
                  <input name="type" type="hidden" id="type" value="member">
                  <input name="username" type="hidden" id="username" value="<?php echo $tempUser; ?>">
                  <input name="date" type="hidden" id="daste" value="<?php echo urlencode($date); ?>"></td>
              </form>
            </tr>
            <tr align="center">
              <form name="form3" method="post" action="sendemail.php">
                <td height="33" valign="middle">
                  <input type="submit" name="Submit222" value="Email Account Holder" style="background-color:#ddd !important;cursor:pointer;margin-bottom:-6px;">
                  <input name="id" type="hidden" id="id45" value="<?php echo $_GET['id']; ?>">
                  <input name="type" type="hidden" id="type" value="member">
                  <input name="username" type="hidden" id="username4" value="<?php echo $tempUser; ?>">
                  <input name="email" type="hidden" id="date4" value="<?php echo $tempEmail; ?>"></td>
              </form>
            </tr>
			
			<tr align="center">
			<div class="" style="position:absolute;margin-top:150px;margin-left:-150px;background-color:#ddd;border-radius:4px;padding:5px;"><a href="change_state.php?id=<?php echo $_GET['id']; ?>">Edit Location</a></div>            
            </tr>
			<tr align="center">
				<form name="form3" method="post" action="">
					<td height="33" valign="middle">
						<input type="submit" name="Submit3232" value="Forced Logout" style="background-color:#ddd !important;cursor:pointer;margin-bottom:-6px;">
						<input name="id" type="hidden" id="id45" value="<?php echo $_GET['id']; ?>">
						<input name="type" type="hidden" id="type" value="member">
						<input name="username" type="hidden" id="username4" value="<?php echo $tempUser; ?>">
						<input name="email" type="hidden" id="date4" value="<?php echo $tempEmail; ?>">
					</td>
				</form>
            </tr>
        </table></td>
      </tr>
    </table>
	<br>
	<table width="1010" align="center" cellpadding="10" bgcolor="#F5F5F5" class="form_def">
      <tr>
        <td width="25%" align="left"><strong>Available Tokens : </strong></td>
        <td width="75%" align="left"><p><strong><div style="font-size:20px;color:#669900;"><?php echo $tempMoney; ?></div></strong></p>
          </td>
      </tr>
	  <form name="form1" method="post" action="">
	    </form>
    </table>	
	<p>&nbsp;</p>
	<form name="form2" method="post" action="depositmoney.php">
	  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr class="form_def">
          <td width="31%" align="right"><input name="cents" type="text" id="cents" value="0" size="4" maxlength="4" style="margin-left:-200px;margin-top:-1px;">
     </td>
          <td width="50%">
            &nbsp;
            <input type="submit" name="Submit" value="Add Tokens To Account" style="margin-left:10px;margin-top:-19px;background-color:#ECEAEA;cursor:pointer;">
            <input name="username" type="hidden" id="username" value="<?php echo $tempUser;?>">
            <input name="email" type="hidden" id="email" value="<?php echo $tempEmail;?>">
            <input name="id" type="hidden" id="email3" value="<?php echo $tempId;?>"></td>
          </tr>
      </table>
	  </form>	
	  
	  
	  <form name="form2" method="post" action="removemoney.php">
        <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr class="form_def">
            <td width="40%" align="right"><input name="cents" type="text" id="cents" value="0" size="4" maxlength="4" style="margin-left:-200px;margin-top: 17px;width:230px;">
        </td>
            <td width="50%">
               &nbsp;
               <input type="submit" name="Submit2" value="Remove Tokens From Account" style="margin-left:10px;background-color:#ECEAEA;cursor:pointer;">
              <input name="username" type="hidden" id="username" value="<?php echo $tempUser;?>">
              <input name="email" type="hidden" id="email" value="<?php echo $tempEmail;?>">
            <input name="id" type="hidden" id="id" value="<?php echo $tempId;?>"></td>
          </tr>
        </table>
        <p>&nbsp;</p>
    </form>	
		  

	</td>
  </tr>
</table>
<?php
$result = mysql_query("SELECT * FROM videosessions WHERE member='$tempUser' ORDER BY date DESC");
if($_POST[vs])
{
$result = mysql_query("SELECT * FROM videosessions WHERE member='$tempUser' AND model like '%$_POST[vs]%' ORDER BY date DESC");
}
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
if(!$_POST[vs])
{
$result = mysql_query("SELECT * FROM videosessions WHERE member='$tempUser' ORDER BY date DESC LIMIT $start,$perpage");
}
echo '<table width="1010px"  border="0" align="center" cellpadding="5px" cellspacing="1" bgcolor="#ffffff">
<tr><td width="300px"><form method="post" action=""><input type="text" name="vs" style="position:absolute;margin-top:-50px;margin-left:0px;width:300px;"/> <input style="position:absolute;margin-top:-50px;margin-left:315px;background-color:#ddd;width:300px;cursor:pointer;" type="submit" value=" Search Sessions "/></form></td></tr>
<br>
<br>
<br>
<tr style="background-color:#e8e8e8;height:50px;padding:5px;"><td style="color:#ff00bc;" align="center"><strong>Profile Image</strong></td><td style="color:#ff00bc;" align="center">Broadcaster</td><td style="color:#ff00bc;" align="center">Date</td><td style="color:#ff00bc;" align="center">Duration</td><td style="color:#ff00bc;" align="center">CPM</td><td style="color:#ff00bc;" align="center">Paid</td><td style="color:#ff00bc;" align="center">Type</td></tr>';


while($row = mysql_fetch_array($result)) 
{

echo "<tr class='form_definitions' padding='50px'><td width='20px'><img src='../models/$row[model]/thumbnail.jpg' width='100px' height='65px'></td><td align='center'>$row[model]</td><td align='center'>".date("d M Y, G:i:s", $row[date])."</td><td align='center'>$row[duration] Seconds</td><td align='center'>$row[cpm] Tokens</td><td align='center'>".round((($row[duration]/60)*$row[cpm]))." Tokens</td><td align='center'>$row[type]</td></tr>";
}
if(!$_POST[vs])
{
if($total)  
{
 $pages=range(1,ceil($total/$perpage)); 
echo "<tr><td>";
foreach($pages as $pagez) 
{
if($pagez==$page) { echo "<div class='pageNumbers'><b>$pagez</b></div>";echo  " ";}
else { echo "<a href=\"$_SERVER[REQUEST_URI]&page=$pagez\"><div class='pageNumbers'><b>$pagez</b></div></a>"; echo  " ";} 
}
echo "</td></tr>";
}
}
echo '</table>';
?>
<?
include("_footer-admin.php")
?>
