<?
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
  height: 50px;
  z-index: 10;

}


textarea {
   font-size: 22pt;
   font-family:Geneva, Arial, Helvetica, sans-serif;
   font-weight:bold;
    
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




-->

</style>

<?
$money=0;
include ("../dbase.php");
include ("../settings.php");
$result=mysql_query("Select money from chatusers");
while($row = mysql_fetch_array($result)) 
		{
		$money+=$row['money'];
		}
		
		
 if(isset($_POST['submit']))
 {
 	$val = $_POST['welcome']; 
	$insertQuery = "UPDATE  welcome set members ='$val' where 1";
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
 
  	$welcomeQuery = "SELECT members FROM welcome"; 
	$result = mysql_query($welcomeQuery) or die(mysql_error()); 
	$chkN = mysql_num_rows($result) ; 
	if($chkN > 0 ) 
	{
		$valueW = mysql_result($result,0,'members'); 
	}
	else
	{
		$valueW = "Please write something"; 
	}

?>





<div align="center">
<div align="center">
  <table width="1010" border="0" cellpadding="4">
    <tr>
      <td>  <table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">
    <tr>
	<br>
	<br>
	<br>
      <td><div align="center" style="margin-bottom:-50px;">
        <h1>All Registered Members </h1>
      </div></td>
    </tr>
  </table>
</div>
<table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#F8F8F8">
<tr>
	<td align="center">
	<table>
		<tr>
			

<tr>
			<td align="center">
			<h3>Search Members</h3>
			</td>
	  </tr>
		<tr>
			<form method="post" action="<? echo $PHP_SELF?>" >
			<td align="center">
				<input type="text" name="srn" value="" />
			</td>
		</tr>
		<tr>
			<td align="center" valign="middle">
				<input type="submit" name="search" value="Search" style="width:40% !important;background-color:#ddd !important;cursor:pointer;"/>
			</td>
			</form>			
		</tr>
	</table>
	</td>
</tr>
  <tr>
    <td bgcolor="#F8F8F8" class="small_title"><p align="left" class="message" style="margin-bottom:-100px;"><strong>Member currency total: &nbsp;<? echo $money; ?>&nbsp; Tokens</strong></p></td>
  </tr>
</table>


<div align="center">
  <table width="1010" border="0" cellpadding="5">
    <tr>
      <td></td>
    </tr>
  </table>
  <table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">

<tr>
    <td bgcolor="#ffffff">

	  <table width="1010"  bgcolor="#ffffff" border="0" align="center" cellpadding="1" cellspacing="1">
	
	<?php
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		
	include('../dbase.php');

	
	$result = mysql_query("SELECT * FROM chatusers");
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
$result = mysql_query("SELECT * FROM chatusers LIMIT $start,$perpage");
if($_POST[srn])
{
$result = mysql_query("SELECT * FROM chatusers WHERE user like '%$_POST[srn]%' OR email='$_POST[srn]' ");
}
	while($row = mysql_fetch_array($result)) 
	{	
		$result3=mysql_query("SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
			while($row3 = mysql_fetch_array($result3)) {
			$tempCountry=$row3[name];
			}
		if ($color=="#ffffff"){
			$color="#ffffff";
			}else{ $color="#ffffff";}
			

		echo'<div class="rows" bgcolor="000000"><tr bgcolor="'.$color.'" class="form_definitions"><td align="left"><b>'.$row[user].'</b></td><td>'.$tempCountry.'</td><td>'.$row[email].'</td><td align="right"><a href="memberviewdetails.php?id='.$row[id].'">View Details</a></td></tr></div>';	
		

	}

	  if(!$_POST[srn])
{
if($total)  
{
 $pages=range(1,ceil($total/$perpage)); 
echo "<tr><td>";
foreach($pages as $pagez) 
{
if($pagez==$page) { 

echo "<b>$pagez</b>";echo  " ";}


else { 


echo "<a href=\"members.php?page=$pagez\">$pagez</a>"; echo  " ";} 
}
echo "</td></tr>";
}
}
	?>


	
      </table>
<br>	</td>
  </tr>
</table></td>
    </tr>
  </table>
</div>
<?
include("_footer-admin.php")
?>