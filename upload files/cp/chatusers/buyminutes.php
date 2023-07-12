<?php
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatusers" )

{

header("location: ../../login.php");

} else{

include("../../dbase.php");

$result=mysql_query("SELECT user from chatusers WHERE id='".$_COOKIE['id']."' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];	}

}

include("_members.header.php");
?>
<style type="text/css">
.token_box{width:150px;height:175px;float:left;background:#8EC1DA url(../../images/rounded.png);margin:10px;}
.token_box h1{color:#8F0000;padding-top:5px;margin:0 auto;text-align:center;}
.token_box h2{color:black;padding-top:5px;margin:0 auto;text-align:center;}
.token_box h3{color:black;padding-top:5px;margin:0 auto;text-align:center;}
.token_box .btn {margin-top:20px;text-align:center;opacity:1.0;filter:alpha(opacity=100);}
.token_box .btn:hover {margin-top:20px;text-align:center;opacity:0.8;filter:alpha(opacity=95);}
.main-buyminutes-class {
    background-color: #00000030;
    width: 90%;
    margin: 30px auto;
    display: table;
    padding: 20px;
	color: #<?php echo $packagePageText; ?>;
}


.token_price_sec .token_box_seciton{

    background-color:#<?php echo $packageBoxBackground;  ?>;
    background-image: url("<?php echo $packageBackgroundImage;  ?>") !important;


}


a{
   color:# !important;
   

}









</style>
<?php 
$resultjkjk = mysql_query("SELECT * from chatusers WHERE id='".$_COOKIE['id']."'");
$row2222 = mysql_fetch_array($resultjkjk);
if(($row2222["gender"]=="Female") OR ($row2222["gender"]=="TMTOF")){ ?>
<style>
.token_box_seciton .btn.dddeeff a, .buyminutes-left-side.leftttttt_tt a {
    border-radius: 4px;
    color: #<?php echo $buyNowButton1Text; ?> !important;
    font-size: 14px !important;
    padding: 5px 14px;
    text-align: center;
    text-decoration: none;
    text-transform: capitalize;
    background: #<?php echo $buyNowButton1; ?> !important;
}
</style>
<?php } else if(($row2222["gender"]=="Male") OR ($row2222["gender"]=="TFTOM")){  ?>	
<style>
.token_box_seciton .btn.dddeeff a, .buyminutes-left-side.leftttttt_tt a {
    border-radius: 4px;
    color: #<?php echo $buyNowButton1Text; ?> !important;
    font-size: 14px !important;
    padding: 5px 14px;
    text-align: center;
    text-decoration: none;
    text-transform: capitalize;
    background: #<?php echo $buyNowButton1; ?> !important;
}

</style>
<?php } ?>
<div class="main-buyminutes-class">
	<div class="col-md-12 img_sec_billl">
		<div class="col-md-6 col-sm-6 col-xs-12 bill_left_text">
			<div class="buyminutes-left-side">Date: <?php echo date("m-d-Y"); ?></div>
			<div class="buyminutes-left-side" style="font-size:28px;">Tokens in your account:           
				<?php
				include("../../dbase.php");
				$result=mysql_query("SELECT money from chatusers where user='$username' LIMIT 1");
				while($row = mysql_fetch_array($result)){
					echo $row['money'];
				} 
				?>
				<div class="buyminutes-left-side leftttttt_tt">	
					<a href="viewsessions.php">Account History</a>
				</div>
			</div>
		</div>
		<div class="col-md-6 cil_right_sec_img">
			<img src="/imagesnhd/billcom.png" class="right-section">
		</div>
	</div>


	<div class="col-md-12">
		<div class="buyminutes-second-section">
			<span>Add funds to your member account using a credit or debit card</span>
			<span>Now you can pay even faster with our newly customized CC Bill payment system. </span>
		</div>
	</div>
	<?php
		$result12=mysql_query("SELECT user from chatusers WHERE id='".$_COOKIE['id']."' LIMIT 1");
		$row12 = mysql_fetch_array($result12); 
		echo $row12[''];
		
	?>
	<div class="col-md-12">
		<?php
		$query=mysql_query("select * from package order by price asc");
		while($row=mysql_fetch_object($query))
		{
		?>
		<div class="col-md-3 col-sm-4 col-xs-12 token_price_sec">
			<div class="token_box_seciton">
				<p style="font-size:28px;"><?php echo $row->name; ?></p>
				<p style="font-size:14px;"><?php echo $row->tokens; ?> Tokens</p>
				<p style="font-size:14px;">Price $<?php echo $row->price; ?></p>
				<div class="btn dddeeff">
					<a href="ccbill.php?amt=<?php echo $row->price; ?>&usr=<?php echo $username; ?> ">
						Buy Now
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<script language="javascript" type="text/javascript">
	function validte()
	{
	if (document.getElementById('txtAmount').value == "")
	{
		alert("Please enter Amount");
		document.getElementById('txtAmount').focus();
		return false;
	}
	if (parseFloat(document.getElementById('txtAmount').value )<2.95)
	{
		alert("Amount should be above $ 2.95");
		document.getElementById('txtAmount').focus();
		return false;
	}
	return true;
	}
	</script>
</div>


<?php 
/*<span class="style2">Date: 
	<?php echo date("m-d-Y"); ?>
</span>  
<span class="style2">Tokens in your account:           
	<?php
	include("../../dbase.php");
	$result=mysql_query("SELECT money from chatusers where user='$username' LIMIT 1");
	while($row = mysql_fetch_array($result)){
		echo $row['money'];
	} 
	?>
	<ul id="css3menu1" class="topmenu">
		<li class="topmenu">
			<a href="viewsessions.php" style="height:10px;line-height:10px;">Account History</a>
		</li>
	</ul>
</span>
<span class="style1">Add funds to your member account using a credit or debit card</span>
<span class="style1">Now you can pay even faster with our newly customized CC Bill payment system. </span>
<?php
$query=mysql_query("select * from package order by price asc");
while($row=mysql_fetch_object($query))
{
echo '<div class="token_box"><h1>'.$row->name.'</h1><h2>'.$row->tokens.' Tokens</h2><h3>Price $'.$row->price.'</h3><div class="btn"><a href="ccbill.php?amt='.$row->price.'&usr='.$username.'"><img src="../../images/buy-package-btn-lg.png" /></a></div></div>';
}*/
 ?>

<?php include("_members.footer.php"); ?>