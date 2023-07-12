<?php include("_header-admin.php");
include('../dbase.php'); 
//echo $_GET['id'];
$result = mysql_query("SELECT * FROM chatusers WHERE id='".$_GET['id']."'");
$row = mysql_fetch_array($result);
$tempState=$row["state"];
$tempCountry = $row["country"];
if(isset($_POST['submit'])){
	$Country = $_POST['Country'];
	$State = $_POST['State'];
	mysql_query("UPDATE chatusers SET country='$Country', state='$State'  WHERE id = '".$_GET['id']."'");
	//header("Location: http://localhost:8080/meet2eat/index.php");
	header("location: memberviewdetails.php?id=".$_GET['id']);
}
?>
<style>
.main-container-seciton {
    float: left;
    width: 100%;
    position: relative;
    margin-top: 6%;
}






</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
function showStates(){  
var input_data1 = $('#Country').val();
if(input_data1==236){
	var input_data2 = "<div class='statessss'><select name='State' id='State_id' ><?php include ("../dbase.php"); include ("../settings.php"); $result = mysql_query('SELECT * FROM states ORDER BY id'); while($row = mysql_fetch_array($result)) { echo"<option value='$row[states]'"; if (isset($_POST['states']) && $_POST['states']==$row['states']){ echo "selected"; } echo ">$row[states]</option>"; } mysql_free_result($result); ?></select></div>";
	$(".showing_states").html(input_data2);
}else{
	var input_data2 = "<div class='statessss'><input name='State' type='text' id='State' value='<?php echo $tempState;?>' size='24' maxlength='24'></div>";
	$(".showing_states").html(input_data2);
}
}
</script>
<div align="center" class="main-container-seciton">
	<table width="1010" border="0" cellpadding="10">
		<tr>
			<td>
				<div align="center">
					<div align="center">
						<table width="1010" height="70">
							<tr>
								<td><div align="center"><h1><?php echo $row['name']; ?></h1></div></td>
							</tr>
						</table>
					</div>
				</div>
			</td>
		</tr>
	</table>
	<div class="chant-ste">
		<form name="form2" method="post" >
			<select name="Country" id="Country" onchange="showStates()">
				<?php
				include ("../../dbase.php");
				include ("../../settings.php");
				$result = mysql_query('SELECT * FROM countries ORDER BY name');
				while($row = mysql_fetch_array($result)) {
					echo"<option value='$row[id]'";
					if ($tempCountry==$row['id']){
						echo "selected";
					}
					echo ">$row[name]</option>";
				}
				?>
			</select>
			<div class="first_seciton_right_side showing_states" style="width:200px;">
				<?php
					include ("../../dbase.php");
					include ("../../settings.php");
					$resultss1 = mysql_query('SELECT * FROM states where states="'.$tempState.'" ORDER BY id');
					$rowss1 = mysql_num_rows($resultss1);
					if($rowss1>0){
				?>							
				<select name="State" id="State_id">
					<?php
					$result = mysql_query('SELECT * FROM states ORDER BY id');
					while($row = mysql_fetch_array($result)) {
						echo"<option value='$row[states]'";
						if ($tempState==$row['states']){
							echo "selected";
						}
						echo ">$row[states]</option>";
					}
					?>
				</select>
				<?php } else { ?>
					<input name="State" type="text" id="State" value="<?php echo $tempState;?>" size="24" maxlength="24" style="width:200px;">
				<?php } ?>
			</div>
			<div style="width:200px;"><input type="submit" name="submit" value="Save"></div>
		</form>	
	</div>
</div>
<?php include("_footer-admin.php"); ?>
