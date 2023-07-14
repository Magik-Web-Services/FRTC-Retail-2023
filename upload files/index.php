<?php
include('./cache.php');

if (isset($_COOKIE["usertype"])) {

	include("_main.header.logged.in.php");
} else {

	include("_main.header.php");
}



$models_per_page = 48;		// never make this 0, never 50, 15

$max_page_show = 15;

$model_order = 'order by RAND()';

if (!isset($_GET['page'])) {

	$page = 1;

	$query_add = " $model_order limit " . ($page - 1) . ", $models_per_page";
} else {

	$page = $_GET['page'];

	$query_add = " $model_order limit " . (($page - 1) * $models_per_page) . ",$models_per_page";
}

$select = "SELECT * FROM chatmodels WHERE 1";

$result = mysqli_query($conn, $select);

$nTotal = mysqli_num_rows($result);

mysqli_free_result($result);

if ($max_page_show >= $nTotal) {

	$start_from = 1;

	$loop_till = ceil($nTotal / $models_per_page);
} else {

	if ($page > $max_page_show) {

		$start_from = $page;
	} else {

		$start_from = 1;
	}

	$loop_till = ($max_page_show + $page);
}



include("geoip/geoip.inc");

$gi = geoip_open("geoip/GeoIP.dat", GEOIP_STANDARD);

$cc = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);

geoip_close($gi);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="assets/css/style2.css">
<link href="fonts2/font_family.css" type="text/css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="assets/js/js2/bootstrap.js"> </script>
<script src="assets/js/js2/jquery.bxslider.js"></script>
<script src="assets/js/script2.js"></script>

<?php if ((isset($_COOKIE["name"])) != "showpopuphomepage") { ?>







<?php } ?>

<?php



#

function GetAge($Birthdate)

#

{

	#

	// Explode the date into meaningful variables

	#

	list($BirthDay, $BirthMonth, $BirthYear) = explode("/", $Birthdate);

	#

	// Find the differences

	#

	$YearDiff = date("Y") - $BirthYear;

	#

	// $MonthDiff = date("m") - $BirthMonth;
	$MonthDiff = date("m");

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





// models thumbnails per page //

$perpage = 48;



if (isset($_GET["page"])) {

	$page = intval($_GET["page"]);
} else {

	$page = 1;
}

$calc = $perpage * $page;

$start = $calc - $perpage;



$count = 0;

$nTime = time();

$result = mysqli_query($conn, "SELECT * from chatusers ");
if (isset($_COOKIE['id']) && !$_COOKIE['id']) {
	$result .= "WHERE id='" . $id . "'";
}

$rows = mysqli_fetch_array($result);

$result = mysqli_query($conn, "SELECT * from countries WHERE id='" . $rows['country'] . "'");

$rows_country = mysqli_fetch_array($result);

$result = mysqli_query($conn, "SELECT * from states WHERE states='" . $rows['state'] . "'");

$rows_state = mysqli_fetch_array($result);

$result = mysqli_query($conn, "SELECT model from blockedcountry WHERE name='" . $rows_country['name'] . "'");

$models = '';

$modelsd = '';

while ($row_model = mysqli_fetch_array($result)) {

	$models = $row_model['model'];

	$modelsd .= " and user!='" . $models . "'";
}

$result = mysqli_query($conn, "SELECT model from blockedstates WHERE states_code='" . $rows_state['states_code'] . "'");

$models_s = '';

$modelsd_s = '';

while ($row_state_model = mysqli_fetch_array($result)) {

	$modelss = $row_state_model['model'];

	$modelsd .= " and user!='" . $modelss . "'";
}

if (!isset($_GET['category'])) {

	$select1 = "SELECT * FROM chatmodels WHERE status='online' AND Spy_Shows='no' $modelsd order by rand() Limit $start, $perpage"; //100hours

	$_total_modl = mysqli_num_rows($result);
} else {

	$select1 = "SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='online' AND Spy_Shows='no' $modelsd order by rand() Limit $start, $perpage";
}



$ip = $_SERVER['REMOTE_ADDR']; // This is your IP address. //

$query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));

//print_r($query);

if ($query && $query['status'] == 'success') {



	$region = $query['region'];
}





//$select1="select * from chatmodels c where not exists(select id from blockedcountry b where b.model=c.user  and b.cc='$cc') and not exists(select id from blockedstates d where d.model=c.user and (d.cc='$region' OR d.states_code='$region') and c.status='online' and c.category='Most Popular' order by rand() Limit $start, $perpage";

//$select1="select * from chatmodels where status='online' and $modelsd order by rand() Limit $start, $perpage";

$result1 = mysqli_query($conn, $select1);

$_total_modl = mysqli_num_rows($result1);

$rows = mysqli_num_rows($result1); ?>

<div class="refreshh">
	<div class="col-md-2 no-padding mobile-sidebar-class">

		<?php

		/*$query=mysql_query("select * from category order by id asc");

while($row=mysql_fetch_object($query))

{

$cats[]=$row->name;

}

$cat_array=array_chunk($cats,7);

$columns=count($cat_array);*/



		echo '<h3 class="category_heading">Categories</h3>';



		foreach ($cat_array as $cat) {

			foreach ($cat as $c) {

				$dbcat = base64_encode($c);

				$getcat = base64_decode((isset($_GET['category']) && !empty($_GET['category'])) ? $_GET['category'] : '');

				if ($getcat == $c) {



					echo '<ul><li><a href="category.php?category=' . $dbcat . '" class="collection-item second-nv-active">' . $c . '</a></li></ul>';
				} else if (($getcat == "") and (url() == "http://m.buildsite1.info") and ($c == "Featured")) {

					echo '<ul><li><a href="category.php?category=' . $dbcat . '" class="collection-item second-nv-active">' . $c . '</a></li></ul>';
				} else {



					echo '<ul class="sidebar_filters"><li><a href="category.php?category=' . $dbcat . '" class="">' . $c . '</a></li></ul>';
				}
			}
		}

		?></div>

	<?php

	if ($rows) {

		$i = 0;

		echo '<div class="col-md-10 no-padding"><div class="row anothehrhe_refreshsh" id="card">

	<div id="fadeIn" class="cbp-rfgrid"><ul>';

		while ($row = mysqli_fetch_array($result1)) {

			$tBirthD = GetAge($row['birthDate']);

			//$nYears=date('Y',time()-$tBirthD)-1970;

			$username = $row['user'];

			$tempMessage = $row['message'];

			$tempCity = $row['city'];

			$tempPlace = $row['broadcastplace'];

			$tempL1 = $row['language1'];

			$tempL2 = $row['language2'];

			$status = $row['status'];

			$gndr = $row['gender'];

			$views = $row['views'];

			$phonechat = $row['phonechat'];

			if ($views == "") {

				$total_viewss = "0";
			} else {

				$total_viewss = $views;
			}

			$gender = substr($gndr, 0, 1);

			//$diff = date_diff(date_create($tBirthD), date_create($tBirthD));

			//echo 'Age is '.$diff->format('%y');

			if (($gndr == "Female") or ($gndr == "TMTOF")) {

				$femacls = "fe_color_change";
			} else if (($gndr == "Male") or ($gndr == "TFTOM")) {

				$femacls = "ma_color_change";
			}



			$htmll = '

		

		<li>

			<a class="showThumbnail oopsshere ' . $femacls . '" href="liveshowchat.php?model=' . $username . '" rel="' . $username . '"  style="">

				

					<img class="fadeIn" src="models/' . $username . '/thumbnail.jpg">


						<div class="simple"><img src="images/add-model.png" style="width:0px;height:0px;float:left;padding:3px 0px 0px 0px;cursor:pointer;" class=""><h3 style="margin-left:-15px;background-color:#161616ab;padding-left:3px;padding-right:3px;padding-top:5px;padding-bottom:2px;width:100%;margin-bottom:0px;">&nbsp;<i style="color:#fff;margin-left:3px;" class="fas fa-video"></i>&nbsp; ' . $username . ' <span style="margin-right:8px;" class="card-age ' . $femacls . '">' . $tBirthD . '/' . $gender . '</span></h3><img src="images/blank.png" style="display:none;width:34px;height:14px;position:absolute;top:5px;left:5px;opacity:0.8;"></div>';






			if ($phonechat == 'yes') {



				$htmll .= 	'<span class="" style="width:20px;height:15px;cursor:pointer;opacity:1 !important;"><img src="/images/featured.png" style="width:85px;position:absolute;margin-top:0px;right:-2px;opacity:1 !important;"></span>';
			}







			$htmll .= '

			</a>

			</li>';





			echo $htmll;
		}
	}

	?></ul>











	<div align="center">

		<p>&nbsp;</p>





		<div class="hoverbox" align="center"><br>

			<!--  
			<a href="index.php" id="join-button" style="opacity:1.0; margin-left: 10px;">SHOW MORE</a>

-->
		</div>

		<br />



	</div>



</div>
</div>

</div>

</div>

<?php

// print_r($_COOKIE['postedArticle']);

?>





<div class="center">

	<div class="pagination">

		<?php



		if (isset($page)) {

			$result = mysqli_query($conn, "SELECT * from chatusers ");
			if (isset($_COOKIE['id']) && !$_COOKIE['id']) {
				$result .= "WHERE id='" . $id . "'";
			}

			$rows = mysqli_fetch_array($result);

			$result = mysqli_query($conn, "SELECT * from countries WHERE id='" . $rows['country'] . "'");

			$rows_country = mysqli_fetch_array($result);

			$result = mysqli_query($conn, "SELECT * from states WHERE states='" . $rows['state'] . "'");

			$rows_state = mysqli_fetch_array($result);

			$result = mysqli_query($conn, "SELECT model from blockedcountry WHERE name='" . $rows_country['name'] . "'");

			$models = '';

			$modelsd = '';

			while ($row_model = mysqli_fetch_array($result)) {

				$models = $row_model['model'];

				$modelsd .= " and user!='" . $models . "'";
			}

			$result = mysqli_query($conn, "SELECT model from blockedstates WHERE states_code='" . $rows_state['states_code'] . "'");

			$models_s = '';

			$modelsd_s = '';

			while ($row_state_model = mysqli_fetch_array($result)) {

				$modelss = $row_state_model['model'];

				$modelsd .= " and user!='" . $modelss . "'";
			}

			if (!isset($_GET['category'])) {

				$select12 = "SELECT * FROM chatmodels WHERE status='online' $modelsd order by rand() Limit $start, $perpage"; //100hours

				$result15 = strlen($select12);
			} else {

				$select12 = "SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='online' $modelsd order by rand() Limit $start, $perpage";

				$result15 = strlen($select12);
			}

			//$select12="select * from chatmodels c where not exists(select id from blockedcountry b where b.model=c.user  and b.cc='$cc') and not exists(select id from blockedstates d where d.model=c.user  and d.cc='CHD') and c.status='online' and c.category='Most Popular' order by rand() Limit $start, $perpage";




			$query1 = mysqli_query($conn,$select12);

			$rows = mysqli_num_rows($query1);


			if ($rows) {



				/*$rs = mysql_fetch_assoc($result12);

		echo $total = $rs["Total"];*/
			}

			$totalPages = ($result15 / $perpage);

			if ($page <= 1) {

				//echo "<span id='page_links' style='font-weight: bold;'>&laquo;</span>";

			} else {

				$j = $page - 1;

				echo "<span><a id='page_a_link' href='index.php?page=$j'>&laquo;</a></span>";
			}

			for ($i = 1; $i <= $totalPages; $i++) {

				if ($i <> $page) {

					$page_active = "pagination_inactive";
				} else {

					$page_active = "pagination_active";
				}



				echo "<span><a id='page_a_link' class=" . $page_active . " href='index.php?page=$i'>$i</a></span>";
			}

			if ($page == $totalPages) {

				//echo "<span id='page_links' style='font-weight: bold;'>&raquo;</span>";

			} else {

				if ($result15 > $perpage) {

					$j = $page + 1;

					echo "<span><a id='page_a_link' href='index.php?page=$j'>&raquo;</a></span>";
				}
			}
		}

		?>

	</div>

</div>

<div align="center">

	<script type="text/javascript">
		$("img.lazy").lazyload({
			effect: "fadeIn",

			effectspeed: 1000
		}).removeClass("lazy");

		$(document).ajaxStop(function() {

			$("img.lazy").lazyload({

				effect: 1000

			}).removeClass("lazy");

		});
	</script>

	<style>
		.pagination_active {

			background-color: #fb41b5;

			color: white;

			border: 1px solid #ddd;

		}
	</style>

	<!--p>      

<?

/*$start = microtime(true);

	$end = microtime(true);

	printf("Page was generated in %f seconds", $end - $start);*/

?>

</p-->

</div>





<?php include("_main.footer.php"); ?>