<?php
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatusers" )

{

header("location: ../../registration/user.php");

} else{

include("../../dbase.php");

$result=mysql_query("SELECT user from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];	}

}

$temail="";

$tsms="";

if ( $_POST['hiddenField']=="yes" &&$_POST['email']=="true"){

	mysql_query("UPDATE chatusers SET emailnotify='1' WHERE user='$username'");

	$temail="1";

} else if ($_POST['hiddenField']=="yes" &&$_POST['email']==""){

	mysql_query("UPDATE chatusers SET emailnotify='0' WHERE user='$username'");

	$temail="0";

	}

if ( $_POST['hiddenField']=="yes" && $_POST['sms']=="true"){

	mysql_query("UPDATE chatusers SET smsnotify='1' WHERE user='$username'");

	$tsms="1";

	} else if ($_POST['hiddenField']=="yes" && $_POST['sms']=="") {

	mysql_query("UPDATE chatusers SET smsnotify='0' WHERE user='$username'");

	$tsms="0";

	}

if ($temail==""){

	$result=mysql_query("SELECT emailnotify from chatusers WHERE user='$username' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{

	$temail=$row['emailnotify'];

	}

}

if ($tsms==""){

	$result=mysql_query("SELECT smsnotify from chatusers WHERE user='$username' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{

	$tsms=$row['smsnotify'];

	}

}

if (isset($_GET['remove']) && $_GET['remove']!=""){

mysql_query("DELETE from favorites WHERE model='$_GET[remove]' AND member='$username' LIMIT 1");

}

include("_members.header.php");
?>

<script>
$(document).ready(function() {
$("img.lazy").lazyload({effect : "fadeIn",

    	effectspeed: 1000 });
});
 </script>
 <style type="text/css">
.user_favorites_profile_seciton_sec{
    width: 90% ;
    margin: 0 auto;
    display: table;
}
.sub_seciton_favorites {
    background-color: #00000030;
  /*  box-shadow: 1px 1px 3px #999; */
    margin: 29px 0px;
    padding: 30px 20px;
    float: left;
    width: 100%;
}

.backgorund_urll:hover {
   /* box-shadow: 0px 0px 0px 0px; */
}


.backgorund_urll {
    background-color: #<? echo $thumbBorderColor ?>;
    margin-bottom: 30px;
    float: left;
    width: 100%;
}


.backgorund_urll12 span a:first-child {
   /* padding: 12px 10px 0 !important; */
  /*  float: left; */
  padding-top:3px;
    width: 100%;
}


.backgorund_urll12 span a h3 {
    float: left;
    width: 100%;
    margin: 0;
    font-size: 17px;
    background-color: #FF0000;
    padding: 6px 0;
    color: #fff;
}



.backgorund_urll12 span a{
	text-align:center;
}

.no-padding{
	padding:0px;
}

span.gndddr {
    float: right;
}

p.usrnmm {
  /*  float: left; */
  margin: 0 0 0px;
}


.viewss {
    float: left;
    width: 100%;
    background-color: #<? echo $thumbBarColor2 ?>;
    color: #<? echo $thumbTextColor ?>;
	text-align: center;
}

</style>
<script>
$(document).ready(function(){
setInterval(function(){
$(".refreshh").load("favorites.php .user_favorites_profile_seciton_sec")
}, 150000);
});
</script>

<?

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






<div class="refreshh">
	<div class="user_favorites_profile_seciton_sec">
		<div class="sub_seciton_favorites">
			<div class="col-md-12 no-padding">
				<?php 
				$nTime=time();
				$result=mysql_query("SELECT * from chatusers WHERE id='".$_COOKIE['id']."'");
				$rows = mysql_fetch_array($result);
				$result=mysql_query("SELECT * from countries WHERE id='".$rows['country']."'");
				$rows_country = mysql_fetch_array($result);
				
				$result=mysql_query("SELECT * from states WHERE states='".$rows['state']."'");
				$rows_state = mysql_fetch_array($result);
				//echo "SELECT model from blockedcountry WHERE cc='".$rows_country['country_code']."'";
				
				$result=mysql_query("SELECT model from blockedcountry WHERE name='".$rows_country['name']."'");
				$models='';
				$modelsd='';
				while($row_model = mysql_fetch_array($result))
				{	
		
					//echo"<pre>";
					//print_r($row_model); 
					//echo"</pre>m";
			
					$models=$row_model['model'];
					$modelsd .=" and user!='".$models."'";
					
				}

				//echo"<br>";
				//echo "SELECT model from blockedstates WHERE states_code='".$rows_state['states_code']."'"; 
				//echo"<br>";
				$result=mysql_query("SELECT model from blockedstates WHERE states_code='".$rows_state['states_code']."'");
				$models_s='';
				$modelsd_s='';
				while($row_state_model = mysql_fetch_array($result))
				{	
					//echo"<pre>";
					//print_r($row_state_model); 
					//echo"</pre>";		
					$modelss=$row_state_model['model'];
					$modelsd .=" and user!='".$modelss."'";
					
				}
			
				$result = mysql_query("SELECT t1.*, t2.* FROM favorites AS t1,chatmodels AS t2 WHERE t1.member='$username' AND t2.user=t1.model AND t2.status!='pending' AND t2.status!='offline' AND t2.status!='rejected' $modelsd order by rand()"  );
				//$result = mysql_query("SELECT t1.*, t2.* FROM favorites AS t1,chatmodels AS t2");
				//$rows = mysql_num_rows($result);
				//echo count($rows);
				while($row = mysql_fetch_array($result))
				{
					$tBirthD=$row['birthDate'];
					$nYears=date('Y',time()-$tBirthD)-1970;
					$username=$row['user'];
					$tempMessage=$row['message'];
					$tempCity=$row['city'];
					$tempPlace=$row['broadcastplace'];
					$tempL1=$row['language1'];
					$tempL2=$row['language2'];
					$status=$row['status'];
					$gender=$row['gender'];
					$views=$row['views'];
					$phonechat=$row['phonechat'];
					
					if($views==""){
						$total_viewss= "0";
					}else{
						$total_viewss= $views;
					}
					if(($gender=="Female") OR ($gender=="TMTOF")){
						$femacls = "fe_color_change";
					} else if(($gender=="Male") OR ($gender=="TFTOM")){
						$femacls = "ma_color_change";
					}
					?>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<div class="backgorund_urll">
						<div class="backgorund_urll12">
							<a class="showThumbnail" href="../../liveshowchat.php?model=<?php echo $username; ?>" rel="<?php echo $username; ?>">
								<div class="hoverbox">
									<img class="img-responsive lazy" src="../../models/<?php echo $username; ?>/thumbnail.jpg" data-original="../../models/<?php echo $username; ?>/thumbnail.jpg" width="100%" height="auto" border="0">
								</div>
							</a>
							<span class="modelbox_title <?php echo $femacls; ?>">
								<a href="../../liveshowchat.php?model=<?php echo $username; ?>">
									<p class="usrnmm" style="font-size:12px !important;padding-left:3px;padding-top:5px !important;"><?php echo $username; ?></p><span class="gndddr" style="font-size:12px !important;padding-right:3px;"></span>
								</a>
																
																
																
																
																
																
																
								<a href="favorites.php?remove=<?php echo $username; ?>"><h3>Remove</h3></a>
							</span>
						</div>
					</div>
				</div>
				<?php } mysql_free_result($result); ?>
			</div>
		</div>
	</div>
</div>
<?php include("_members.footer.php"); ?>