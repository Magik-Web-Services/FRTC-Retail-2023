<!DOCTYPE html>

<html lang="en">
<head>

<?php
include("dbase.php");
include("settings.php");
$userid = $_COOKIE['id'];
$result23=mysql_query("SELECT * from chatusers WHERE id='$_COOKIE[id]'");
$row44 = mysql_fetch_array($result23);
if($row44['forced_logout']=='yes'){
	header("Location: logout.php");
}
$result2300=mysql_query("SELECT * from chatmodels WHERE id='$_COOKIE[id]'");
$row4400 = mysql_fetch_array($result2300);
if($row4400['forced_logout']=='yes'){
	header("Location: logout.php");
}
mysql_query("UPDATE chatmodels SET Spy_Shows='no' WHERE id='$userid'");
$result=mysql_query("SELECT user,freetime,freetimeexpired,loginkey from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");
while($row = mysql_fetch_array($result)) 
{	
	$username=$row['user'];	
	$freetime=$row['freetime'];
	$freetimeexpired=$row['freetimeexpired'];
	
	session_start();
						
	if($row['loginkey'] != $_SESSION["loginkey"]){	
	
	//header('Location:../../logout.php');
	 
	echo "<script>window.location='logout.php'</script>";
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
$query=mysql_query("select * from category order by id asc");
while($row=mysql_fetch_object($query))
{
$cats[]=$row->name;
}
$cat_array=array_chunk($cats,7);
$columns=count($cat_array);
?>


<!-- Start top bar categories code  -->

<?php
$query=mysql_query("select * from category_top order by id asc");
while($row=mysql_fetch_object($query))
{
$cats_top[]=$row->name;
}
$cat_array_top=array_chunk($cats_top,7);
$columns=count($cat_array_top);
?>











<title><?php echo $sitename; ?></title>

<!-- CSS  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="cssnhd/bootstrap.css" type="text/css" rel="stylesheet">
<link href="cssnhd/style.css" type="text/css" rel="stylesheet">
<link href="font-awesomenhd/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="cssnhd/media.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css2/grid-2.css" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<style>




.col-md-5{
    margin-right:1px !important;

}







body {
margin:0; 

/* background-image: inherit !important;   */

font-weight: normal !important;  

font-size: 14px !important; 

/* background-color: #fff !important; */

background-image: linear-gradient(#<? echo $homepageBackgroundColor1; ?>, #<? echo $homepageBackgroundColor2; ?>) !important;
background-repeat:no-repeat !important;

background-color:#<? echo $homepageBackgroundColor1; ?>;


}


.topnav {
  background-color:;
/*  width: 100%; */

  align:right; 
  float:right;
  margin-right:20px;
}


/* Top Nav Bar Buttons */

.topnav a {
  border: 1px solid #<? echo $TopButtonOutlineColor ?>;
  border-radius: 4px;
  background-color: #<? echo $TopButton ?>;
  color: #<? echo $TopButtonText ?>;
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
  background-color: #<? echo $TopButtonHover ?>;
  color: #<? echo $TopButtonTextHover ?>;
  border: 1px solid #<? echo $TopButtonHoverOutlineColor ?>;
  border-radius: 4px;
}

/* .active {
  background-color: #<? echo $TopButtonActive ?>;
  color: #<? echo $TopButtonTextActive ?>;
  border: 1px solid #<? echo $TopButtonActiveOutlineColor ?>;
  border-radius: 4px;
}
*/


.topnav .icon {
  display: none;
}



/* Bottom header bar opacity  */

.bgsgsgcls.fixed-headr {
    width: 100%;
    z-index: 999;
   /* background-color: #000; */

	
}



.after_login_section ul.jflkjdfl {
    z-index: 99999999;
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
    background-image: linear-gradient(#<? echo $topBarColor1 ?>, #<? echo $topBarColor2 ?>) !important;
    float: left;
    padding: 4px 0;
    width: 100%;
	
/* Top bar opacity */

    height:55px;
	opacity:0.9;

}


/* Top Bar 2 Color  */

.col-md-l2.hide-on-med-and-down {
    padding: 13px 26px 13px;
    background: #<? echo $topBarColor2 ?>;
	display:none !important;

}


.phone-header {
    color: #<? echo $scrollTextColor ?>;
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

margin: 0;

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

margin: 0;

outline: none;

padding: 0 19px;

text-align: center;

text-decoration: none;

text-shadow: 0 1px hsla(0,0%,100%,.4);



}







/* pretty yellow button */

#join-button-mobile{

background: #fc0;

background: linear-gradient(180deg,#fc0,#f98706);

border: 0;

border-radius: 2px;

box-shadow: 0 1px 0 rgba(0,0,0,.3);

color: #441f00 !important;

cursor: pointer;

display: inline-block;

font: 700 14px/40px arial,sans-serif;

height: 40px;

margin: 0;

outline: none;

padding: 0 19px;

text-align: center;

text-decoration: none;

text-shadow: 0 1px hsla(0,0%,100%,.4);



}







#join-button-mobile:hover{

background: #fc0;

background: linear-gradient(180deg,#ffd429,#f98706);

border: 0;

border-radius: 2px;

box-shadow: 0 1px 0 rgba(0,0,0,.3);

color: #441f00 !important;

cursor: pointer;

display: inline-block;

font: 700 14px/40px arial,sans-serif;

height: 40px;

margin: 0;

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

</script>
<script>
var IDLE_TIMEOUT = 600000; //10 minutes
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
        document.location.href = "<? echo $siteurl ?>logout.php";
    }
}
</script>

</head>
<body >

<?
//You will be auto logged out in <span id="SecondsUntilExpire"></span> seconds.
?>
<div class="navbar-fixed">
	<nav class="pinkcs desktopmenu" role="navigation">
		<div class="nav-wrapper">
			<tr>
				<td class="top-right-td" valign="top"><!-- Start css3menu.com BODY section -->
					<ul id="css3menu1" class="topmenu headermaintopleft col-md-3">
						<li class="topmenu col-md-12 col-sm-6"><a href="<? echo $siteurl ?>"><center><img src="images/logo1.png"></center></a></li>	
						<li class="topmenu  col-md-6 col-sm-6">	
						</li>       
					</ul>
					<div class="phone-header col-md-4 col-sm-12"><? echo $headerLabel ?> <marquee scrolldelay="<? echo $scrollingSpeed ?>"> <? echo $scrollText ?></marquee></div>
				</td>	 
				<?php
				if($_COOKIE['usertype']=='chatmodels')
				{
					$result=mysql_fetch_array(mysql_query("SELECT user from chatmodels WHERE id='$_COOKIE[id]' LIMIT 1"));
					$model=$result['user'];
				}
				?>					
				<td class="top-left-td" valign="top" align="right"><!-- Start css3menu.com BODY section -->
					<ul id="css3menu1" class="col-md-5 col-sm-12 topmenu hhhhhff afte_login_vk">
						<div class="topnav after_login_section" id="myTopnav">
							<?php if($username) { ?>
							<li><a href="index.php"><i class="fas fa-video"></i>&nbsp;Live Cams</a></li>
							<?php } ?>

							<?php if($_COOKIE['id']==""){ ?>
							<li><a href="registration/model.php">Broadcast Yourself</a></li>
							<?php } ?>
							<li class="dropdown">

                                							
								<ul class="jflkjdfl-OFF">

									<?php 
									if($username) {
										echo '<li><a href="cp/chatusers/buyminutes.php">My Account</a></li>
										<li><a href="cp/chatusers/favorites.php">Followed</a></li>
										<li><a href="cp/chatusers/updateprofile.php">My Profile</a></li>
										<li><a href="cp/chatusers/viewsessions.php">My History</a></li>
										<li><a href="logout.php">Logout</a></li>';
									} 
									if($model) {
										echo '<li><a href="cp/chatmodels/paymentop.php">My Account</a></li>
										<li><a href="cp/chatmodels/broadcast.php">Broadcast</a></li>
										<li><a href="cp/chatmodels/updateprofile.php">My Profile</a></li>
										<li><a href="cp/chatmodels/showslist.php">My History</a></li>
										<li><a href="cp/chatmodels/uploadpicture.php">My Pictures</a></li>
										<li><a href="logout.php">Logout</a></li>';
									} 
									?>
	
								</ul>
								
					        
							
							<li><a href="/cp/chatusers/buyminutes.php" id="join-button" style="margin-left:5px">Get Tokens</a></li>

														
								
								
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
		<div class="collection">
		<?php 
		function url(){
			if(isset($_SERVER['HTTPS'])){
				$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
			}
			else{
				$protocol = 'http';
			}
			return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		} 
		

		
		
		foreach($cat_array_top as $cat_top)
			{
			foreach($cat_top as $c)
			{
				$dbcat_top = base64_encode($c);
				$getcat_top = base64_decode($_GET['category']);
				if($getcat_top==$c){
					echo '<a href="category.php?category='.$dbcat_top.'" class="collection-item second-nv-active">'.$c.'</a>';
				}else if(($getcat_top=="") AND (url()) AND ($c=="Most Popular")){
					echo '<a href="category.php?category='.$dbcat_top.'" class="collection-item second-nv-active">'.$c.'</a>';
				}else{
					echo '<a href="category.php?category='.$dbcat_top.'" class="collection-item">'.$c.'</a>';
				}
			}	
		}
		
		?>
		</div>		
	</div>
	</div>
	<div class="mobile-menu transparent-bac_colour">
		<div class="top-mob-header" style="background-color:#<? echo $topBarColor1 ?> !important;">
			<div class="toggle-btn">
				<span class="tog-bor"></span>
				<span class="tog-bor"></span>
				<span class="tog-bor"></span>
			</div>
			<div class="mob-logo"><a href="<? echo $siteurl ?>"><img src="images/logo1.png"></a></div>
		</div>	
		<div class="toggle-mob-menu">
			<div class="login-btn"><a href="cp/chatusers/buyminutes.php" class="active"> Get Tokens</a></div>
			<div class="main-drop-sec mob-menu-category">
				<h3 class="drop-menu-mob">categories <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
				<div class="collection-mob drop-data-mob">
				<?php
				foreach($cat_array as $cat)
				{
					foreach($cat as $c)
					{
						$dbcat = base64_encode($c);
						$getcat = base64_decode($_GET['category']);
						if($getcat==$c){
							echo '<a href="category.php?category='.$dbcat.'" class="collection-item second-nv-active">'.$c.'</a>';
						}else if(($getcat=="") AND (url()) AND ($c=="Most Popular")){
							echo '<a href="category.php?category='.$dbcat.'" class="collection-item second-nv-active">'.$c.'</a>';
						}else{
							echo '<a href="category.php?category='.$dbcat.'" class="collection-item">'.$c.'</a>';
						}
					}	
				}
				echo $username;
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
				<li><a href="store.php">Store</a></li>
				<?php if($_COOKIE['id']==""){ ?>
				<li><a href="registration/model.php">Broadcast Yourself</a></li>
				<?php } ?>
				<li class="main-drop-sec login-drop">
					<h3 class="drop-menu-mob"><? if (isset($username)){echo $username;} ?><? if (isset($model)){echo $model;} ?> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
					<div class="collection-mob drop-data-mob">
					<?php 
					if($username) {
						echo '<a class="collection-item" href="cp/chatusers/buyminutes.php">My Account</a>
						<a class="collection-item" href="cp/chatusers/favorites.php">Followed</a>
						<a class="collection-item" href="cp/chatusers/updateprofile.php">My Profile</a>
						<a class="collection-item" href="cp/chatusers/viewsessions.php">My History</a>
						<a class="collection-item" href="cp/chatusers/buyminutes.php">My Money</a>
						<a class="collection-item" href="logout.php">Logout</a>';
					} 
					if($model) {
						echo '<a class="collection-item" href="index.php">My Account</a>
						<a class="collection-item" href="cp/chatmodels/broadcast.php">Broadcast</a>
						<a class="collection-item" href="cp/chatmodels/updateprofile.php">My Profile</a>
						<a class="collection-item" href="cp/chatmodels/showslist.php">My History</a>
						<a class="collection-item" href="cp/chatmodels/uploadpicture.php">My Pictures</a>
						<a class="collection-item" href="cp/chatmodels/paymentop.php">My Money</a>
						<a class="collection-item" href="logout.php">Logout</a>';
					} 
					?>
					
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
		<a href="<? echo $siteurl ?>/new/matcss.php#">
			<div class="model-button" align="right">
				<div align="center">MODEL SIGNUP</div>		
			</div>
		</a>
	</div>
</div> 
<div class="topbore"></div>
<div class="row"></div>
<div class="row bac_colour">