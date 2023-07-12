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





.form_definitions{
    background-color:#eaeaea;
	color:#fff;
	border:solid;
	border-width:0.5px;
	border-color:#ccc;
	border-radius:4px;
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
		
		
 if(isset($_POST['pack']))
 {      echo 'hmmm';
 	mysql_query("insert into category (name)values('$_POST[name]')");
	$conn = mysql_insert_id();
	if($conn) 
	{
		?>
		<script type="text/javascript">
		alert("The data was saved successfully.");
		</script>
		<?
	}
 }		
  if(isset($_GET['delete']))
 {
mysql_query("delete from category where id='$_GET[delete]' ");
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
      <td><div align="center">
	  <p>&nbsp;</p>
      <p>&nbsp;</p>
        <h1>Add / Remove Categories</h1>
      </div></td>
    </tr>
  </table>
</div>
<table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#F8F8F8">
<tr>
	<td align="center">
	<table><form method="post" action="<?php echo $PHP_SELF?>" >

<tr>
			<td align="center">
			<h3>Category name</h3>
			</td>
	  </tr>
		<tr>
			
			<td align="center">
				<input type="text" name="name" value="" placeholder="Enter name"/>
			</td>
		</tr>

		<tr>
			<td align="center" valign="middle">
				<input type="submit" name="pack" value="Add" style="width:100px !important;background-color:#ddd !important;cursor:pointer;"/>
			</td>
					
		</tr></form>	
	</table>
	</td>
</tr>
</table>


<div align="center">
  <table width="70%" border="0" cellpadding="5">
<thead><th align="left">Category name</th></thead>
<?php
$query=mysql_query("select * from category order by name asc");
while($row=mysql_fetch_object($query))
{
echo '<tr class="form_definitions"><td>'.$row->name.'</td><td><a href="?delete='.$row->id.'"><div class="" style="font-size:18px;float:right !important;">&#9940;</a></td></tr>';
}
?>
    
  </table>
</div>
<?
include("_footer-admin.php")
?>