<!DOCTYPE html>

<html lang="en">
<head>
<?php
	include("../../dbase.php");
	include("../../settings.php");
	$result23=mysql_query("SELECT * from chatusers WHERE id='$_COOKIE[id]'");
	$row44 = mysql_fetch_array($result23);
	if($row44['forced_logout']=='yes'){
		header("Location: ../../logout.php");
	}
	$result=mysql_query("SELECT user,freetime,freetimeexpired,loginkey from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
	{	$username=$row['user'];	
		$freetime=$row['freetime'];
		$freetimeexpired=$row['freetimeexpired'];
		
			session_start();
						
					if($row['loginkey'] != $_SESSION["loginkey"]){	
					
					//header('Location:../../logout.php');
					 
                    echo "<script>window.location='../../logout.php'</script>";
					//echo "not equal";
	
					}else{
						
						//echo "equal";
						
					}
		
	}
	if ($freetime==0 && (time()-$freetimeexpired)>(3600*$freehours)){
		mysql_query("UPDATE chatusers SET freetime='120', freetimeexpired='0' WHERE id='$_COOKIE[id]' LIMIT 1");
		$freetime=120;
	}
mysql_query("UPDATE chatmodels SET status='offline' WHERE $nTime-lastupdate>30 AND status!='rejected' AND status!='blocked' AND status!='pending' AND forcedOnline='0'");
?>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
$query=mysql_query("select * from category order by id ASC");
while($row=mysql_fetch_object($query))
{
$cats[]=$row->name;
}
$cat_array=array_chunk($cats,7);
$columns=count($cat_array);
?>


<!-- start category top bar code  -->

<?php
$query=mysql_query("select * from category_top order by id ASC");
while($row=mysql_fetch_object($query))
{
$cats_top[]=$row->name;
}
$cat_array_top=array_chunk($cats_top,7);
$columns=count($cat_array_top);
?>



<!-- End category top bar code  -->


<title><?php echo $sitename; ?></title>

<!-- CSS  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../../cssnhd/bootstrap.css" type="text/css" rel="stylesheet">
<link href="../../cssnhd/style.css" type="text/css" rel="stylesheet">
<link href="../../font-awesomenhd/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../cssnhd/media.css" type="text/css" rel="stylesheet">

<style>


body {
margin:0; 
/* background-image: inherit !important;  */
font-weight: normal !important;  
font-size: 14px !important; 
background-color: #<?php echo $mainSiteBackgroundColor; ?> !important; 


}






.topnav {
  background-color: transparent;
/*  width: 100%; */

    align:right; 
  

    float:right;

  
  /*  margin-right:-150px; */
    
	width: 100% !important;
    padding-left:110px;
}










/* Top Nav Bar Buttons */

.topnav a {
  border: 1px solid #<?php echo $TopButtonOutlineColor ?>;
  border-radius: 4px;
  background-color: #<?php echo $TopButton ?>;
  color: #<?php echo $TopButtonText ?>;
  display: block;
  float: left;
  font-size: 14px !important;
  padding: 4px 7px;
  text-align: center;
  text-decoration: none;
  text-transform: capitalize;
  margin-left: 3px;
 /* margin-top: 2px; */
}



.topnav a:hover {
  background-color: #<?php echo $TopButtonHover ?>;
  color: #<?php echo $TopButtonTextHover ?>;
  border: 1px solid #<?php echo $TopButtonHoverOutlineColor ?>;
  border-radius: 4px;
}

.active {
  background-color: #<?php echo $TopButtonActive ?>;
  color: #<?php echo $TopButtonTextActive ?>;
  border: 1px solid #<?php echo $TopButtonActiveOutlineColor ?>;
  border-radius: 4px;
}



.topnav .icon {
  display: none;
}



/* Bottom header bar opacity  */

.bgsgsgcls.fixed-headr {
    width: 100%;
    z-index: 999;
    background-color: #000;

	
}



.after_login_section ul.jflkjdfl {
    z-index: 99999999;
	width:900px;
}



/*center header break - padding adjusts the spacing*/

.bgsgsgcls {
    float: left;
    width: 100%;
    padding-top: 0px;
}
.myanothercss {
    margin: 30px 0 0;
    float: left;
    width: 100%;
}


/* Newer VAR CSS */


/* Top Bar Color */

.pinkcs {
    background-image: linear-gradient(#<?php echo $topBarColor1 ?>, #<?php echo $topBarColor2 ?>) !important;
    padding: 4px 0;
    width: 100%;
	
/* Top bar opacity */
	
   height:55px;


}


/* Top Bar 2 Color  */

.col-md-l2.hide-on-med-and-down {
    padding: 13px 26px 13px;
    background: #<?php echo $topBarColor2 ?>;

	display:none;
}


.phone-header {
    color: #<?php echo $scrollTextColor ?>;
    padding: 12px 33px !important
	
	}




/* pretty yellow button */

#join-button{

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

margin-right: 1px;

outline: none;

padding: 0 19px;

text-align: center;

text-decoration: none;

text-shadow: 0 1px hsla(0,0%,100%,.4);




}







#join-button:hover{

background: #fc0;

background: linear-gradient(180deg,#ffd429,#f98706);

border: 0;

border-radius: 2px;

box-shadow: 0 1px 0 rgba(0,0,0,.3);

color: #441f00 !important;

cursor: pointer;

display: inline-block;

font: 700 14px/30px arial,sans-serif;

height: 30px;

margin-right: 1px;

outline: none;

padding: 0 19px;

text-align: center;

text-decoration: none;

text-shadow: 0 1px hsla(0,0%,100%,.4);



}











@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
.open > .dropdown-menu
}
@media screen and (max-width: 991px) and (min-width: 768px) {
.afte_login_vk {
    width: 100% !important;
}
}
@media screen and (max-width: 1160px) and (min-width: 992px) {
.afte_login_vk {
    width: 47% !important;
}
}
</style>
<script>
jQuery( document ).ready(function() {
   $(window).scroll(function(){
	  var sticky = $('.navbar-fixed'),
		  scroll = $(window).scrollTop();

	  if (scroll >= 100) sticky.addClass('fixed-headr');
	  else sticky.removeClass('fixed-headr');
	});
	$(window).scroll(function(){
		var sticky = $('.bgsgsgcls'),
		scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('fixed-headr');
		else sticky.removeClass('fixed-headr');
	});
});
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
<script>
$(document).ready(function(){
	$(".drop_manu").hide();
    $(".dropdown-toggle.hide_sec").click(function(){
       jQuery(".drop_manu").toggal('');
    });
});
</script>

<script>
/*$(document).ready(function(){
	var unloaded = false;
$(window).on('beforeunload', unload);
$(window).on('unload', unload);	 
function unload(){	
	if(!unloaded){
		$('body').css('cursor','wait');
		$.ajax({
			type: 'get',
			async: false,
			url: window.location.origin+'../../logout.php',
			success:function(){ 
				unloaded = true; 
				$('body').css('cursor','default');
			},
			timeout: 3000
		});
	}
}
});*/
</script>
<script>
var IDLE_TIMEOUT = 60000; //10 minute
var _idleSecondsTimer = null;
var _idleSecondsCounter = 0;

document.onclick = function() {
    _idleSecondsCounter = 0;
};

document.onmousemove = function() {
    _idleSecondsCounter = 0;
};

document.onkeypress = function() {
    _idleSecondsCounter = 0;
};

_idleSecondsTimer = window.setInterval(CheckIdleTime, 10000);

function CheckIdleTime() {
     _idleSecondsCounter++;
     var oPanel = document.getElementById("SecondsUntilExpire");
     if (oPanel)
         oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        window.clearInterval(_idleSecondsTimer);
        alert("Time expired!");
        document.location.href = "<?php echo $siteurl ?>logout.php";
    }
}
</script>

</head>
<body>

<div class="navbar-fixed">
	<nav class="pinkcs desktopmenu" role="navigation">
		<div class="nav-wrapper">
			<tr>
				<td class="top-right-td" valign="top"><!-- Start css3menu.com BODY section -->
					<ul id="css3menu1" class="topmenu headermaintopleft col-md-3">
						<li class="topmenu col-md-12 col-sm-6"><center><a href="<?php echo $siteurl ?>"><img src="../../images/logo.png"></a></center></li>	
						<li class="topmenu  col-md-6 col-sm-6">	
						</li>       
					</ul>

				</td>	  
				<td class="top-left-td" valign="top" align="right"><!-- Start css3menu.com BODY section -->
					<ul id="css3menu1" class="col-md-5 col-sm-12 topmenu hhhhhff after_login_vk">
						<div class="topnav after_login_section" id="myTopnav">
							<!--ul id="css3menu1" class="topmenu">
								<li class="topmenu">
								<a href="#" style="height:10px;line-height:10px;"><span>
							<?php if (isset($username)){echo $username;} ?> </span></a>
								<div class="submenu" style="width:92px;">
								<ul>
									<li><a href="index.php">My Account</a></li>
									<li><a href="favorites.php">My Favorites</a></li>
									<li><a href="updateprofile.php">My Profile</a></li>
									<li><a href="viewsessions.php">My History</a></li>
									<li><a href="buyminutes.php">My Money</a></li>
									<li><a href="../../logout.php">Logout</a></li>
								</ul></li>
							</ul-->
							
							<?php if($username) { ?>
							
							<?php } ?>

							<?php if($_COOKIE['id']==""){ ?>
							<li><a href="../../registration/model.php">Broadcast Yourself</a></li>
							<?php } ?>
							<li class="dropdown">

								<ul class="jflkjdfl-off">
								    <li><a href="../../index.php"><i class="fas fa-video"></i>&nbsp;Live Cams</a></li>
									<li><a href="buyminutes.php">My Account</a></li>
									<li><a href="favorites.php">Followed</a></li>
									<li><a href="updateprofile.php">My Profile</a></li>
									<li><a href="viewsessions.php">My History</a></li>
									<li><a href="../../logout.php">Logout</a></li>
									<li><a href="/cp/chatusers/buyminutes.php" id="join-button">Get Tokens</a></li>
								</ul>
							</li>
							  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onClick="myFunction()">&#9776;</a>
						</div>
					</ul>
				</td>
			</tr>
		</div>
	</nav>
	
	
	<div class="bgsgsgcls">
	
	<div class="col-md-l2 hide-on-med-and-down dfdf">
	<!-- <div style="float:right; v-align:middle;"><a href="/cp/chatusers/buyminutes.php" id="join-button">Get Tokens</a></div> -->
	
		<div class="collection">
		<?php
			foreach($cat_array_top as $cat_top)
			{
			foreach($cat_top as $c)
			{
			$dbcat_top = base64_encode($c);
			echo '<a href="../../category.php?category='.$dbcat_top.'" class="collection-item" id="login-btn">'.$c.'</a>';
			}	
			}

		?>
		
		
		
		
		</div>
				
	</div>
	
	
</div>



	<div class="mobile-menu transparent-bac_colour">
		<div class="top-mob-header" style="background-color:#<?php echo $topBarColor1 ?> !important;">
			<div class="toggle-btn">
				<span class="tog-bor"></span>
				<span class="tog-bor"></span>
				<span class="tog-bor"></span>
			</div>
			<div class="mob-logo"><a href="<?php echo $siteurl ?>"><img src="<?php echo $siteurl ?>/images/logo.png"></a></div>
		</div>	
		<div class="toggle-mob-menu">
			<div class="login-btn"><a href="buyminutes.php" class="active" style="">Get Tokens</a></div>
			<div class="main-drop-sec mob-menu-category">
				<h3 class="drop-menu-mob">categories <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
				<div class="collection-mob drop-data-mob">
				<?php
					foreach($cat_array as $cat)
					{
					foreach($cat as $c)
					{
						$dbcat = base64_encode($c);
						echo '<a href="../../category.php?category='.$dbcat.'" class="collection-item">'.$c.'</a>';
					}	
					}
					if($username) {
						echo '<a href="cp/chatusers/favorites.php" class="collection-item">Followed</a>';
					}	
				?>
				</div>
			</div>
			
			<ul class="mob-menu-dest">
				<?php if($username) { ?>
				<li><a href="/cp/chatusers/buyminutes.php">Get Tokens</a></li>
				<?php } ?>
				<li><a href="../../store.php">Store</a></li>
				<?php if($_COOKIE['id']==""){ ?>
				<li><a href="../registration/model.php">Broadcast Yourself</a></li>
				<?php } ?>
				<li class="main-drop-sec login-drop">
					<h3 class="drop-menu-mob"><?php if (isset($username)){echo $username;} ?> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
					<div class="collection-mob drop-data-mob">
					<a href="buyminutes.php">My Account</a>
					<a href="favorites.php">Followed</a>
					<a href="updateprofile.php">My Profile</a>
					<a href="viewsessions.php">My History</a>
					<a href="buyminutes.php">My Money</a>
					<a href="../../logout.php">Logout</a>
					</div>
				</li>
				<li class="main-drop-seclogin-drop"></li>
				<li class="main-drop-seclogin-drop"></li>
			</ul>
		</div>
	</div>
</div>
<div class="col l2 hide-on-med-and-down">	
	<div class="bar2" height="35px">
		<a href="<?php echo $siteurl ?>/new/matcss.php#">
			<div class="model-button" align="right">
				<div align="center">MODEL SIGNUP</div>		
			</div>
		</a>
	</div>
</div> 
<div class="topbore"></div>
<div class="row"></div>
<div class="row bac_colour">

	