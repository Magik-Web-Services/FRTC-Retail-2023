<?php 
if (isset($_COOKIE["usertype"])){
	include("_main.header.logged.in.php");	
} else {
include("_main.header.php");		  
} 
$models_per_page = 50;		// never make this 0, never
$max_page_show = 15;
$model_order = 'order by RAND()';
if (!isset($_GET['page']))
{
	$page=1;
	$query_add = " $model_order limit ".($page-1).", $models_per_page";
}
else
{
	$page = $_GET['page'];
	$query_add = " $model_order limit ".(($page-1)*$models_per_page).",$models_per_page";
}
$select="SELECT * FROM chatmodels WHERE 1" ;
$result = mysqli_query($conn, $select);
$nTotal=mysqli_num_rows($result);
mysqli_free_result($result);
if ($max_page_show >= $nTotal)
{
	$start_from = 1;
	$loop_till = ceil($nTotal/$models_per_page);
}
else
{
if ($page > $max_page_show)
{
	$start_from = $page;
}
else
{
	$start_from = 1;
}
	$loop_till = ($max_page_show+$page);
}

include("geoip/geoip.inc");
$gi = geoip_open("geoip/GeoIP.dat", GEOIP_STANDARD);
$cc=geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
geoip_close($gi);
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="https://malsup.github.com/jquery.cycle.all.js"></script>
<script type='text/javascript' src='/js/jquery.lazyload.min.js'></script>
<style type="text/css">
body {
	
	background-image: linear-gradient(#<?php echo $homepageBackgroundColor1; ?>, #<?php echo $homepageBackgroundColor2; ?>) !important;
	background-repeat:no-repeat !important;
	scrollbar-color: #87ceeb #ff5621 !important;

	
}
.user_cat_lists_seciton_sec{
    width: 90% ;
    margin: 0 auto;
    display: table;
}

.sub_cat_lists_viewsessions {
    background-color: #EEE;
    box-shadow: 0px 0px 3px #999;
    margin: 29px 0px;
	margin-bottom: 50px;
    padding: 30px 20px;
    float: left;
    width: 100%;
}
.backgorund_urll:hover {
    box-shadow: 0px 0px 0px 0px;
}







.sidebar_filters a:active {
    background: #<?php echo $sidebarHoverColor;  ?> !important;
    color: #<?php echo $sidebarTextHoverColor;  ?> !important;
    font-weight: 700;
    padding: 0px 0px 0px 20px;
}







.backgorund_urll {
    background-color: #<?php echo $thumbBorderColor ?>;
    box-shadow: 0px 0px 0px 2px #<?php echo $thumbBarColor1 ?>;
    margin-bottom: 30px;
    float: left;
    width: 100%;
}


.backgorund_urll12 span a:first-child {
    padding: 12px 0 0 !important;
    float: left;
    width: 100%;
	
}


.backgorund_urll12 span a h3 {
    float: left;
    width: 100%;
    margin: 0;
    font-size: 17px;
    background-color: #222;
    padding: 6px 0;
    color: #<?php echo $thumbTextColor ?>;
}


.backgorund_urll12 span a{
	text-align:center;
}


.no-padding{
	padding:0px;
}


.viewss {
    float: left;
    width: 100%;
    background-color: #<?php echo $thumbBarColor2 ?>;
    color: #<?php echo $thumbTextColor ?>;
	text-align: center;
}


.in-private {
    position: relative;
}


.in-private p.in-privte {
    position: absolute;
    bottom: 0;
    float: right;
    width: 100%;
    text-align: right;
    margin: -1px;
}


.in-private p.in-privte span {
    background-color: red;
    padding: 2px 2px;
    text-transform: uppercase;
    color: #<?php echo $thumbTextColor ?>;
    font-size: 9px;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
}

.viewss {
    float: left;
    width: 100%;
    background-color: #<?php echo $thumbBarColor2 ?>;
    color: #<?php echo $thumbTextColor ?>;
	
	
}


.refreshh {
    margin: 25px 0;
	
}



.anothehrhe_refreshsh {
    width: 99%;
    margin: 0 auto;
    display: table;
    margin-top: -25px;
	margin-bottom:20px;
}


.myanothercss {
    background-color: #EEEEEE;
    box-shadow: 0px 0px 3px #999999;
    margin: 29px 0px;
    padding: 30px 20px;
    float: left;
    width: 100%;

}




.backgorund_urll {
    background-color: #<?php echo $thumbBorderColor ?>;
    box-shadow: 0px 0px 0px 2px #<?php echo $thumbBarColor1 ?>;
    margin-bottom: 30px;
    float: left;
    width: 100%;

}








.category_heading {

    background: #<?php echo $sidebarTopColor; ?>;

    border-bottom: 1px solid #<?php echo $sidebarBorderColor; ?>;

    box-sizing: border-box;

    color: #<?php echo $sidebarTextColor; ?>;

    cursor: pointer;

    display: block;

    font-weight: 700;

    height: 36px;

    line-height: 36px;

    padding: 0 20px;

    position: relative;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

	margin-bottom:0px;

	margin-top:-30px;

    font-size: 16px !important;
	
    padding-top: 10px !important;



}




.sidebar_filters a {

    background: #<?php echo $sidebarMainColor;  ?>;

    border-bottom: 1px solid #<?php echo $sidebarBorderColor;  ?>;

    box-sizing: border-box;

    color: #<?php echo $sidebarTextColor;  ?>;

    display: block;

    font-size: 12px;

    height: 36px;

    line-height: 36px;

    padding: 0 20px;

    position: relative;

    z-index: 1;

}

.sidebar_filters a:hover  {

    background: #<?php echo $sidebarHoverColor;  ?>;

    color: #<?php echo $sidebarTextHoverColor;  ?> !important;

    font-weight: 700;

	padding:0px 0px 0px 20px;

}



.collection-item:hover {
    opacity:1 !important;
	border-radius:0px !important;
}

/* Desktops and laptops ----------- */
@media only screen  and (min-width : 1224px) {
	
.col-md-10 {
    width: 87.333333% !important;
}
.col-md-2 {
    width: 12.666667% !important;
}
.cbp-rfgrid li a:hover div.simple {
    opacity: 1;
    width: 99.40% !important; 

}
}

/* Large screens ----------- */
@media only screen  and (min-width : 1824px) {
.col-md-10 {
    width: 87.333333%;
}
.col-md-2 {
    width: 12.666667%;
}
.cbp-rfgrid li a:hover div.simple {
    opacity: 1;
    width: 99.40% !important;
}
}
@media only screen and (max-width: 768px) {
.col-md-10 {
    width: 100%;
}
.col-md-2 {
    width: 100%;
    margin-bottom: 40px;
}
img.show-more-models {
    width: 100% !important;
    object-fit: contain;
}
.mobile-sidebar-class {
	display:none;
}
}

/* .active {
    background-color: #EA0000 !important;
    color: #FFF !important;
    border: 1px solid #850a08;
  
    opacity: 1.0;
} */




.cbp-rfgrid li a div.simple h3 {

    left: -15px !important;

}



.Female {
  font-size: 0;
}


.Female:first-letter {
  font-size: 12px;
}



.cbp-rfgrid {
    width: 100% !important;
}




</style>

<?php


$getcatt=base64_decode($_GET['category']);
#
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
        $MonthDiff = date("m") ;
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
<!--<script>
$(document).ready(function(){
setInterval(function(){
$(".refreshh").load("category.php?category=<?php echo $_GET['category']; ?> .user_cat_lists_seciton_sec")
}, 15000);
});
</script>-->
<script>

jQuery(function($) {
 var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
 $('ul a').each(function() {
  if (this.href === path) {
   $(this).addClass('active');
  }
 });
});
</script>
<div class="refreshh">
<div class="col-md-2 no-padding mobile-sidebar-class"><?php
echo '<h3 class="category_heading">Categories</h3>';
foreach($cat_array as $cat)
			{
			foreach($cat as $c)
			{
				$dbcat = base64_encode($c);
				$getcat = base64_decode($_GET['category']);
				if($getcat==$c){
					
					echo '<ul class="sidebar_filters"><li><a href="category.php?category='.$dbcat.'" class="">'.$c.'</a></li></ul>';
				}else if(($getcat=="") AND (url()=="$siteurl") AND ($c=="Featured")){
					echo '<ul class="sidebar_filters"><li><a href="category.php?category='.$dbcat.'" class="">'.$c.'</a></li></ul>';
				}else{
					
					echo '<ul class="sidebar_filters"><li><a href="category.php?category='.$dbcat.'" class="">'.$c.'</a></li></ul>';
				}
			}	
		}
?></div>
		<div class="col-md-10 no-padding">
        <div class="row anothehrhe_refreshsh" id="card">
        <div class="cbp-rfgrid"><ul>
			<?php 
			$ip = $_SERVER['REMOTE_ADDR']; // your ip address here
			$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
			if($query && $query['status'] == 'success')
			{
			   
				 $region = $query['region'];
			  
			}
			$nTime=time();
			if (!isset($getcatt))
			{
				$select="SELECT * FROM chatmodels WHERE status='online'".$query_add;//100hours
			} else
			{
				$select="SELECT * FROM chatmodels WHERE category='$getcatt' AND status='online'".$query_add;
			}
			$cat=htmlentities($getcatt);
			$result=mysqli_query($conn, "SELECT * from chatusers WHERE id='".$_COOKIE['id']."'");
			$rows = mysqli_fetch_array($result);
			$result=mysqli_query($conn, "SELECT * from countries WHERE id='".$rows['country']."'");
			$rows_country = mysqli_fetch_array($result);
			
			$result=mysqli_query($conn, "SELECT * from states WHERE states='".$rows['state']."'");
			$rows_state = mysqli_fetch_array($result);
			$result=mysqli_query($conn, "SELECT model from blockedcountry WHERE name='".$rows_country['name']."'");
			$models='';
			$modelsd='';
			while($row_model = mysqli_fetch_array($result))
			{			
				$models=$row_model['model'];
				$modelsd .=" and user!='".$models."'";				
			}
			$result=mysqli_query($conn, "SELECT model from blockedstates WHERE states_code='".$rows_state['states_code']."'");
			$models_s='';
			$modelsd_s='';
			while($row_state_model = mysqli_fetch_array($result))
			{		
				$modelss=$row_state_model['model'];
				$modelsd .=" and user!='".$modelss."'";				
			}
			if($getcatt=="Most Popular"){
				//echo $getcatt;
				$select="select * from chatmodels where status='online' and Spy_Shows='no' $modelsd order by rand() limit 100";	
			}else if($getcatt=="Phone Chat"){
				$select="select * from chatmodels where status='online' AND phonechat='yes' and Spy_Shows='no' $modelsd order by rand() limit 100";
			}else if($getcatt=="Spy Shows"){
				$select="select * from chatmodels where status='online' AND Spy_Shows='yes' $modelsd order by rand() limit 100";
			}else{
				$select="select * from chatmodels where status='online' AND category='$getcatt' and Spy_Shows='no' $modelsd order by rand() limit 100";
			}
			$result = mysqli_query($conn, $select);
			$_total_modl = mysqli_num_rows($result);
			
			while($row = mysqli_fetch_array($result))
			{
				$tBirthD=GetAge($row['birthDate']);
				//$nYears=date('Y',time()-$tBirthD)-1970;
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
				
				
				$gender = substr($gender,0,1);
				
				
				if(($gender=="Female") OR ($gender=="TMTOF")){
					$femacls = "fe_color_change";
				} else if(($gender=="Male") OR ($gender=="TFTOM")){
					$femacls = "ma_color_change";
				}
			?>
			<li>
					<?php //echo $_SERVER['SERVER_NAME']; ?>
						<a class="showThumbnail" href="liveshowchat.php?model=<?php echo $username; ?>" rel="<?php echo $username; ?>">
							
							<?php if($getcatt=="Spy Shows"){ echo "<div class='in-private'>"; } ?>
							
							<img class="img-responsive lazy" src="models/<?php echo $username; ?>/thumbnail.jpg" data-original="<?php echo $siteurl ?>/models/<?php echo $username; ?>/thumbnail.jpg" width="100%" height="auto" border="0" />
							
                           
						   
						   
				<div class="simple"><img src="images/add-model.png" style="width:0px;height:0px;float:left;padding:3px 0px 0px 0px;cursor:pointer;" class=""><h3 style="background-color:#161616ab;margin-left:20px;padding-left:15px;padding-right:3px;padding-top:5px;padding-bottom:2px;width:100%;margin-bottom:0px;">&nbsp; <i style="color:#fff !important;margin-left:-10px;margin-bottom:2px;margin-right:3px;" class="fas fa-video"></i>&nbsp;<?php echo $username; ?> <span style="margin-right:8px;" class="card-age"><?php echo $tBirthD; ?>/<?php echo $gender; ?></span></h3><img src="images/blank.png" style="display:none;width:34px;height:14px;position:absolute;top:5px;left:5px;opacity:0.8;"></div>
						   
						
                         <div class="Female">Female</div>
						
						
						
							<?php if($getcatt=="Spy Shows"){
										echo "<p class='in-privte'><span>in private</span></p></div>";
									}
								?>
								<!--<span class='card-title <?php echo $femacls; ?>' style="background-color:#<?php echo $thumbBarColor1 ?>;">
									<span class='card-name'><div style="color:#<?php echo $thumbTextColor ?>;"><?php echo $username; ?></div></span>
									<span class='card-age'><div style="color:#<?php echo $thumbTextColor ?>;"><?php echo $tBirthD; ?>/<?php echo substr($row['gender'],0,1); ?></div></span>								</span>-->
							<!--<span class="viewer">Views (<?php echo $total_viewss; ?>)</span>--><!--<span class="maincam"><img class="camicon" src="images/camicon.png"></span>-->
								
				<?php
					if($phonechat == 'yes'){
			
	echo	'<span class="" style="width:20px;height:15px;cursor:pointer;opacity:1 !important;"><img src="/images/featured.png" style="width:85px;position:absolute;margin-top:0px;right:-2px;opacity:1 !important;"></span>';
							}
					?>
						</a>					
                    </li>
			
			<?php } mysqli_free_result($result); ?>
		</ul>
        <?php if($_total_modl > 0 && $_total_modl == 5){ ?>
   <div align="center">
		  <p>&nbsp;</p>
		  
		 
         <div class="hoverbox" align="center"><br>

         <!--   
			<a href="javascript:window.location.href=window.location.href" id="join-button" style="opacity:1.0; margin-left: 10px;">SHOW MORE</a>
			-->
			
			</div>
		  <br />

    </div>
   <?php } ?></div>
        </div>
        </div>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
  <?php include("_main.footer.php"); ?>