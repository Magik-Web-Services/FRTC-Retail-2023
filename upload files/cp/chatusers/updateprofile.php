<?php
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatusers" )
{
header("location: ../../login.php");
} else{

include("../../dbase.php");

include("../../settings.php");

$result=mysql_query("SELECT user from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];	}

}

if($_POST['Email']!="" && $_POST['gender']!="" && $_POST['Name'] !="" && $_POST['Country'] !="" && $_POST['State'] !="" && $_POST['City'] !=""&& $_POST['ZipCode'] !="" && $_POST['Adress'] !="" && $_POST['Phone'] !="") 
{	


	include("../../dbase.php");

	$id=$_COOKIE["id"];

	$tempUser=$username;

	$tempPass1=$_POST['Password1'];

	$tempPass2=$_POST['Password2'];

	

	$tempEmail=$_POST['Email'];

	$tempName = $_POST['Name'];
	
	$gender = $_POST['gender'];
	
	$tDay=$_POST['day'];

	$tMonth=$_POST['month'];

	$tYear=$_POST['year'];

	$tempCountry = $_POST['Country'];

	$tempState= $_POST['State'];

	$tempPhone=$_POST['Phone'];

	$tempCity=$_POST['City'];

	$tempZip = $_POST['ZipCode'];

	$tempAdress = $_POST['Adress'];

	

	$month=date("n");

	$year=date("Y");

	$endDate=mktime (0,0,0,22,$month,$year);	
	$currentSeconds = $_POST['day']."/".$_POST['month']."/".$_POST['year'];

	mysql_query("UPDATE chatusers SET phone=$tempPhone, email='$tempEmail', name='$tempName', gender='$gender', birthDate='$currentSeconds', country='$tempCountry', state='$tempState', city='$tempCity', zip='$tempZip', adress='$tempAdress' WHERE id = '$id' LIMIT 1");
     $errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">Your Profile Has Been Updated</p>';
	

	if ($_POST['Password1']!=""){	
    if(strlen(trim($_POST['Password1']))<15 && strlen(trim($_POST['Password1']))>5 )
	{
	 $db_pass=md5($_POST['Password1']);
     mysql_query("UPDATE chatusers SET password='$db_pass' WHERE id = '$id' LIMIT 1");
	
	$errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">Your Password Has Been Updated</p>';
	}
	else
	{
	$errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">Password must be 6 to 14 characters long and may not contain spaces.</p>';
	}

	
  }


}

else if (!isset($_POST['Password1']))

{	

	include("../../dbase.php");

	$id=$_COOKIE["id"];

	$result = mysql_query("SELECT * FROM chatusers WHERE id='".$id."'");

	while($row = mysql_fetch_array($result)) 

	{

		$tempUser=$row["user"];

		$tempPass1=$row["password"];

		$tempPass2=$row["password"];

		$tempState=$row["state"];

		$tempEmail=$row["email"];

		$tempName = $row["name"];
		
		$gender = $_POST['gender'];
	
		$tBirth = explode('/',$row["birthDate"]);
		
		$tDay=$tBirth[0];

		$tMonth=$tBirth[1];

		$tYear=$tBirth[2];

		$tempCountry = $row["country"];

		$tempZip = $row["zip"];

		$tempCity=$row["city"];

		$tempAdress = $row["adress"];

		$tempPhone= $row['phone'];

	}

}else

{

$id=$_COOKIE["id"];

	$tempUser=$username;

	$tempPass1=$_POST['Password1'];

	$tempPass2=$_POST['Password2'];	

	$tempEmail=$_POST['Email'];

	$tempName = $_POST['Name'];
	
	$gender = $_POST['gender'];
	
	$tDay=$_POST['day'];

	$tMonth=$_POST['month'];

	$tYear=$_POST['year'];	

	$tempCountry = $_POST['Country'];

	$tempState= $_POST['State'];

	$tempPhone=$_POST['Phone'];	

	$tempCity=$_POST['City'];

	$tempZip = $_POST['ZipCode'];

	$tempAdress = $_POST['Adress'];






$errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">Please fill in all boxes with valid information.</p>';



} 


include("_members.header.php");
?>
<style type="text/css">




input,
button,
select,
textarea {
  background-color: #<? echo $regInputBackgroundColor ?> !important;
  color:#<? echo $regInputTextColor ?> !important;
  border-color: #<? echo $regInputBorderColor ?> !important;
  outline: none !important;
  border-radius: 2px !important;
  padding: 5px !important;
  border-width: 0.5px !important;
}



/* Button Style */


input[type=submit]{

background: #fc0;

background: linear-gradient(180deg,#fc0,#f98706);

border: 0;

border-radius: 2px;

box-shadow: 0 1px 0 rgba(0,0,0,.3);

color: #441f00 !important;

cursor: pointer;

display: inline-block;

font: 700 14px/30px arial,sans-serif;

height: 30px;

margin: 0;

outline: none;

padding: 0 19px !important;

text-align: center;

text-decoration: none;

text-shadow: 0 1px hsla(0,0%,100%,.4);



}









.userupdate_profile_seciton_sec{
    width: 90% ;
    margin: 0 auto;
    display: table;
}
form.user_update_profile {
    background-color: #<? echo $regTableBackgroundColor ?> !important;
  /*  box-shadow: 1px 1px 3px #999; */
    margin: 29px 0px;
    padding: 20px 52px;
    float: left;
	width: 100%;
}
form.user_update_profile .first_seciton_right_side {
    height: 30px;
}
form.user_update_profile .first_seciton_right_side select {
    width: 40%;
}
form.user_update_profile .informatin_user p {
    font-size: 13px;
    font-weight: bold;
    font-family: arial;
}
.footer_input_reg_birthdate select {
    width: 13% !important;
}
.country-csscste:hover p, .statett-msss:hover p {
	position: absolute;
    top: 0%;
    background-color: #ccc;
    padding: 7px 17px;
    font-size: 11px !important;
    display: block;
}
.country-csscste p, .statett-msss p {
    display: none;
    position: absolute;
    top: 0%;
    background-color: #ccc;
    padding: 7px 17px;
    font-size: 11px !important;
}





</style>

	<div class="userupdate_profile_seciton_sec">
	
	

	
	<?
	
	
	include("../../dbase.php");
	$result=mysql_query("SELECT user from chatmodels WHERE id='".$_COOKIE['id']."' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
	{	
		$username=$row['user'];	
	}
	if (isset($_FILES['ImageFile']['tmp_name']))
	{
		
		unlink("user-images/".$username.".jpg");
		
		$digits = 5;
		$new_site= rand(pow(10, $digits-1), pow(10, $digits)-1);
		
	     // rand(6,100);
		 // $_COOKIE['img']=$new_site;
	
		 
		 
		$urlThumbnail="user-images/".$username.".jpg";
		$urlThumbnaila="user-images/".$username."/".$new_site.".jpg";
		if ($check=getimagesize($_FILES['ImageFile']['tmp_name']))

		{
			$src=imagecreatefromstring(file_get_contents($_FILES['ImageFile']['tmp_name']));	
			$theight=910;
			$twidth=620;
			$tmp=imagecreatetruecolor($theight,$twidth);
			imagecopyresampled($tmp,$src,0,0,0,0,$theight,$twidth,$check[0],$check[1]);
			imagejpeg($tmp,$urlThumbnail,100);
			$errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">Changed Successfully.</p>';
			
			
			
			
			$src=imagecreatefromstring(file_get_contents($_FILES['ImageFile']['tmp_name']));	
			$theight=250;
			$twidth=200;
			$tmp=imagecreatetruecolor($theight,$twidth);
			imagecopyresampled($tmp,$src,0,0,0,0,$theight,$twidth,$check[0],$check[1]);
			imagejpeg($tmp,$urlThumbnaila,100);
			$errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">Changed Successfully.</p>';
			
			
		session_start();
		$_SESSION['img'] = $new_site;

			
		} 
		else
		{		
						$errorMsg='<p align="center" style="color:#FFF;background-color:#74a802;padding:5px;border:solid;border-width:0.5px;border-color:#333;border-radius:4px;">File Not Copied.</p>';		
		}
	}
	include("../../dbase.php");
	
	
	?>
	


	
	
	
	
	    <form name="form1" method="post" class="user_update_profile" action="updateprofile.php">
			<div class="first_seciton_update">
				<span class="form_header_title">User Information </span>
				<div class="col-md-12 informatin_user">
				<div class="Error_mssage">
					<?php if ( isset($errorMsg) && $errorMsg!=""){ echo $errorMsg; } ?>	
				</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side"><p>User name : </p></label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side"><?php echo $tempUser; ?></div>
					</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side"><p>New Password : </p></label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Password1" type="password" id="Password1" size="24" maxlength="14"> 
							<span class="form_informations style1" style="margin-bottom:10px">
								Required only if changing password.
							</span>
						</div>
					</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php
							if($tempEmail==""){ 
								echo "<p class='error'>Email*</p>";
							} else{ 
							echo "<p>Email*</p>"; 
							}
							?>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Email" type="text" id="Email" value="<? echo $tempEmail;?>" size="24" maxlength="50">
						</div>
					</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php 
							if($tempName==""){ 
								echo "<p class='error'>Full Name: *</p>";

							} else{ 
								echo"<p>Full Name: *</p>"; 
							}
							?> 
						
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Name" type="text" id="Name" value="<? echo $tempName;?>" size="24" maxlength="24">
						</div>
					</div>	
					<div class="col-md-2 register_content">
						<?php
						if(isset($_POST['day']) && $_POST['day'] == "") {
							echo "<p class='errer'>Date of Birth*</p>";
						} else{ 
							echo"<p>Date of Birth*</p>";
						}
						?> 
					</div>
					<div class="col-md-10 footer_input_reg footer_input_reg_birthdate">
						<select name="day" id="day">
							<?php
							for($i=1; $i<=31; $i++)
							{
								if ($i<9)
								{
									$a = $i;
									$i='0'.$i;
								}
								echo "<option value='$i'";
								if ($tDay==$i){ echo "selected";}
								echo">$i</option>";
								if ($i<9){ $i = $a; }
							}
							?>
						</select>
						<select name="month" id="month">
							<option value="Jan" <? if ($tMonth=="Jan"){ echo "selected";}?>>January</option>
							<option value="Feb" <? if ($tMonth=="Feb"){ echo "selected";}?>>February</option>
							<option value="Mar" <? if ($tMonth=="Mar"){ echo "selected";}?>>March</option>
							<option value="Apr" <? if ($tMonth=="Apr"){ echo "selected";}?>>April</option>
							<option value="May" <? if ($tMonth=="May"){ echo "selected";}?>>May</option>
							<option value="Jun" <? if ($tMonth=="Jun"){ echo "selected";}?>>June</option>
							<option value="Jul" <? if ($tMonth=="Jul"){ echo "selected";}?>>July</option>
							<option value="Aug" <? if ($tMonth=="Aug"){ echo "selected";}?>>August</option>
							<option value="Sep" <? if ($tMonth=="Sep"){ echo "selected";}?>>September</option>
							<option value="Oct" <? if ($tMonth=="Oct"){ echo "selected";}?>>October</option>
							<option value="Nov" <? if ($tMonth=="Nov"){ echo "selected";}?>>November</option>
							<option value="Dec" <? if ($tMonth=="Dec"){ echo "selected";}?>>December</option>
						</select>
						<select name="year" id="year">
							<?php
							for($i=1950; $i<=date(Y)-17; $i++)
							{
								echo "<option value='$i'";
								if ($tYear==$i){ echo "selected";}
								echo ">$i</option>";
							}
							?>
					  </select>
					</div>
					<div class="col-md-2 register_content">
						<p>Gender*</p>
					</div>
					<div class="col-md-10 footer_input_reg">	
						<select name="gender" id="gender">
						<?php 	
						$resultio = mysql_query("SELECT * FROM chatusers WHERE id='".$_COOKIE['id']."'");
						$rowio = mysql_fetch_array($resultio);
						//echo "<pre>"; print_r($rowio['gender']);
						$gender11 = $rowio['gender'];
						?>
							<option value='Male' <?php if($gender11=="Male"){ echo "selected='selected'"; } ?>>Male</option>
							<option value='Female' <?php if($gender11=="Female"){ echo "selected='selected'"; } ?> >Female</option>
							<option value='TMTOF' <?php if($gender11=="TMTOF"){ echo "selected='selected'"; } ?> >Trans Male To Female</option>
							<option value='TFTOM' <?php if($gender11=="TFTOM"){ echo "selected='selected'"; } ?> >Trans Female To Male</option>
						</select>
					</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side"><p>Country : *</p></label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side country-csscste">
						<?php
						$result = mysql_query("SELECT * FROM countries where id='$tempCountry' ORDER BY name");
						$row = mysql_fetch_array($result);						
						?>
						<input name="Country" type="hidden" id="Country"  value="<?php echo $row['id']; ?>">
							<select name="Country" id="Country" disabled="disabled" >
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
							<p>Please contact site administrator if you want to change that.</p>
						</div>
					</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php
							if($tempState==""){ 
								echo "<p class='error'>State : * </p>";
							} else{ 
								echo"<p>State: * </p>"; 
							}
							?>    
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side statett-msss" >
							<input name="State" type="text" id="State" readonly="readonly" value="<?php echo $tempState;?>" size="24" maxlength="24">
							<p>Please contact site administrator if you want to change that.</p>
						</div>
					</div>					
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php
							if($tempCity==""){ 
								echo "<p class='error'>City : * </p>";
							} else{ 
								echo"<p>City : * </p>"; 
							}
							?>            
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="City" type="text" id="City" value="<? echo $tempCity;?>" size="24" maxlength="24">
						</div>
					</div>					
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php 
							if($tempZip==""){ 
								echo "<p class='error'>Zip Code : *</p>";

							} else{ 
								echo"<p>Zip Code : *</p>"; 
							}
							?>          												
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="ZipCode" type="text" id="ZipCode" value="<?php echo $tempZip;?>" size="24" maxlength="24">	
						</div>
					</div>					
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php 
							if(isset($tempPhone) && $tempPhone==""){
								echo "<p class='error'>Phone : *</p>";

							} else{ 
								echo"<p>Phone : *</p>"; 
							}
							?> 
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Phone" value="<?php if (isset($tempPhone)){ echo $tempPhone; }  ?>" type="text" id="Phone" size="24" maxlength="24">
						</div>
					</div>
					<div class="col-md-2">	
						<label class="first_seciton_left_side">
							<?php 
							if($tempAdress){
								echo "<p class='error'>Address : *</p>";

							} else{ 
								echo"<p>Address : *</p>"; 
							}
							?> 
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<textarea name="Adress" cols="24" rows="5" id="Adress"><?php echo $tempAdress; ?></textarea>
						</div>
					</div>						
					<div class="col-md-2 ">
					</div>						
					<div class="col-md-10 ">
						<div class="upated_all_informatin_user_btn">
							
							
							<input type="submit" name="Submit" value="Update" />
							
							
							<!-- <input name="image2" src="../../images/update-btngirl.png" alt="" class="computer_sec_main" type="text"> -->

							
							
						</div>									
					</div>									
				</div>
			</div>
		</form>
	</div>
<?php include("_members.footer.php"); ?>

