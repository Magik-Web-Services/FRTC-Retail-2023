<?php
include("dbase.php");
$models_per_page = 50;		// never make this 0, never
$max_page_show = 15;
$model_order = 'order by `user`';
if (defined('model_random_sort_order') && 'model_random_sort_order' == true) {
	$model_order = 'order by RAND()';
}

if (!isset($_REQUEST['page'])) {

	$page = 1;

	$query_add = " $model_order limit " . ($page - 1) . ", $models_per_page";
} else {

	$page = $_REQUEST['page'];

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



?>
<?php

$count = 0;
$nTime = time();

if (!isset($_GET['category'])) {
	$select = "SELECT * FROM chatmodels WHERE status='online'" . $query_add; //100hours
} else {
	$select = "SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='online'" . $query_add;
}


$result = mysqli_query($conn, $select);
while ($row = mysqli_fetch_array($result)) {
	$tBirthD = $row['birthDate'];
	$nYears = date('Y', time() - $tBirthD) - 1970;
	$username = $row['user'];
	$tempMessage = $row['message'];
	$tempCity = $row['city'];
	$tempPlace = $row['broadcastplace'];
	$tempL1 = $row['language1'];
	$tempL2 = $row['language2'];
	$status = $row['status'];
	$count++;
	echo '<div class="showMovie"><iframe class="lazy" width="250" height="200" src="thumbnail.php?model=' . $username . '" scrolling="no" frameborder="0"  allowfullscreen></iframe></div>';
}

mysqli_free_result($result);

?>

<?php if ($total > 0 && $total >= $models_per_page) : ?>
	<div id="more-<?php echo $page; ?>" style="clear: both;">
		<br />
		<a href="javascript:void(0);" class="more" rel="<?php echo $page; ?>">show more results</a>
	</div>
<?php endif; ?>