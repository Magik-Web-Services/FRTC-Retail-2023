<?php
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatusers" )
{
header("location: ../../login.php");

} else{

include("../../dbase.php");

$result=mysql_query("SELECT user from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];	}

}

$msgError="";

include("../../dbase.php");

$id=$_COOKIE["id"];

$member=$username;



if (isset($_POST['paymentSum'])){

mysql_query("UPDATE chatmodelsstatus SET minimum='$_POST[paymentSum]' WHERE id = '$id' LIMIT 1");

$msgError="Value has been changed";

}

include("_members.header.php");
?>
<style type="text/css">
.user_viewsessions_seciton_sec{
    width: 90% ;
    margin: 0 auto;
}
.sub_seciton_viewsessions {
    background-color: #0000001c !important;
 /*   box-shadow: 1px 1px 3px #999; */
    margin: 29px 0px;
    padding: 30px 20px;
    float: left;
    width: 100%;
}



.subann11_seciton_viewsessions ul li.heading{
    background-color: #0000003d !important;


}


.subann11_seciton_viewsessions ul li{
    background-color: #00000030 !important;
    border: 0.5px solid #0000001c !important;

}



.viewsession_pagination {
    text-align: center;
    float: left;
    width: 100%;
    padding: 7px 0;
}
.viewsession_pagination span a {
    background-color: #<?php echo $paginationBackgroundColor;  ?>;
    color: #<?php echo $paginationTextColor;  ?>;
    padding: 4px 8px;
    margin-right: 5px;
	border: 1px solid #<?php echo $paginationBorderColor;  ?>;
}

.viewsession_pagination span b, .viewsession_pagination span a:hover  {
    background-color: #<?php echo $paginationBackgroundColorHover;  ?>;
    color: #<?php echo $paginationTextColorHover;  ?>;
    padding: 4px 8px;
    margin-right: 5px;
	border: 1px solid #<?php echo $paginationBorderColorHover;  ?>;
}



@media(device-width: 768px){
::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 7px;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 4px;
        background-color: #05b0fa;
        -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);
    }
}



</style>
<?php


$result = mysql_query("SELECT * FROM videosessions WHERE member='$member' ORDER BY date DESC");
//$result22 = mysql_query("SELECT * FROM videosessions ORDER BY date DESC");
$num_rows1 = mysql_num_rows($result22);
//echo $num_rows1;
if($num_rows1>11){
?>
<style>
.subann_seciton_viewsessions {
    overflow: scroll;
    height: 400px;
}
</style>
<?php }else{ ?>
<style>
.subann_seciton_viewsessions {
    overflow-x: scroll;
    height: auto;
}
</style>
<?php } ?>
<div class="user_viewsessions_seciton_sec">
	<div class="sub_seciton_viewsessions">
		<div class="subann_seciton_viewsessions">
			<div class="subann11_seciton_viewsessions">
				<ul>
					<li class="heading">Performer</li>
					<li class="heading">Date</li>
					<li class="heading">Duration</li>
					<li class="heading">CPM</li>
					<li class="heading">Paid</li>
					<li class="heading">Type</li>
					<?php
					//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
					//$secondsAll=time();
					include('../../dbase.php');
					$count=0;
					$result = mysql_query("SELECT * FROM videosessions WHERE member='$member' ORDER BY date DESC");
					//$result = mysql_query("SELECT * FROM videosessions ORDER BY date DESC");
					$total=mysql_num_rows($result);
					$perpage=20;
					if($_GET['page'])
					{
					$page=$_GET['page'];
					}
					else
					{
					$page=1;
					}
					$start=($page-1)*$perpage;
					$result = mysql_query("SELECT * FROM videosessions WHERE member='$member' ORDER BY date DESC LIMIT $start,$perpage");
					//$result = mysql_query("SELECT * FROM videosessions ORDER BY date DESC LIMIT $start,$perpage");		
					while($row = mysql_fetch_array($result)) 
					{
						$count++;
						
						$ammount= $row['ammount'];

						$model=$row['model'];

						$epercentage=$row['epercentage'];

						$duration=$row['duration'];

						$cpm=$row['cpm'];

						$type=$row['type'];

						if (($duration/60)<round($duration/60))

						{

						$tempMinutesPv=round($duration/60)-1;

						} else {

						$tempMinutesPv=$duration/60;

						}

						$tempSecondsPv=$duration % 60;

						$ammount=round((($duration/60)*$cpm)) ;

						echo'
						<li>'.$model.'</li>
						<li>'.date("d M Y, G:i:s", $row[date]) .'</li>
						<li>'.(($type=='tip')?'NA':$tempMinutesPv.":".$tempSecondsPv).'</li>
						<li>'.$cpm.' Tokens</li>
						<li>'.$ammount.'</li>
						<li>'.$type.'</li>
						';
					}
					?>				
				</ul>
			</div>
		</div>
		<div class="viewsession_pagination">
			<span class="style88">
				<?php 
				if($total)  
				{
					$pages=range(1,ceil($total/$perpage)); 
					foreach($pages as $pagez) 
					{
						if($pagez==$page) { echo "<b>$pagez</b>";echo  " ";}
						else { echo "<a href=\"viewsessions.php?page=$pagez\">$pagez</a>"; echo  " ";} 
					}
				}
				?>
			</span>
		</div>
	</div>
</div>
<?php include("_members.footer.php"); ?>