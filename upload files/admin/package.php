<?php
$PHP_SELF = "";
include("_header-admin.php")
?>




<style type="text/css">
	.selector {
		background-image: url();
		background-color: #FFFFFF;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 50px;
		z-index: 10;
	}

	.form_definitions {
		background-color: #ddd;
		color: #fff;
		border: solid;
		border-width: 0.5px;
		border-color: #ccc;
		border-radius: 4px;
		margin-bottom: 2px;
	}
</style>
<?php
$money = 0;
include("../dbase.php");
include("../settings.php");
$result = mysqli_query($conn, "Select money from chatusers");
while ($row = mysqli_fetch_array($result)) {
	$money += $row['money'];
}


if (isset($_POST['pack'])) {
	mysqli_query($conn, "insert into package (name,tokens,price)values('$_POST[name]','$_POST[tokens]','$_POST[price]')");
	// $conn = mysqli_insert_id();
	if ($conn) {
?>
		<script type="text/javascript">
			alert("The data was saved successfully.");
		</script>
<?php
	}
}
if (isset($_GET['delete'])) {
	mysqli_query($conn, "delete from package where id='$_GET[delete]'");
}
$welcomeQuery = "SELECT members FROM welcome";
$result = mysqli_query($conn, $welcomeQuery);
$chkN = mysqli_num_rows($result);
if ($chkN > 0) {
	// $valueW = mysqli_result($result, 0, 'members');
	$valueW = $result->fetch_assoc()['members'] ?? false;  
} else {
	$valueW = "Please write something";
}

?>


<div align="center">
	<div align="center">
		<table width="1010" border="0" cellpadding="4">
			<tr>
				<td>
					<table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">
						<tr>
							<td>
								<div align="center">

									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<h1>Token Packages </h1>
								</div>
							</td>
						</tr>
					</table>
	</div>
	<table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#F8F8F8">
		<tr>
			<td align="center">
				<table>
					<form method="post" action="<?php echo $PHP_SELF ?>">

						<tr>
							<td align="center">
								<h3 >Package name</h3>
							</td>
						</tr>
						<tr>

							<td align="center">
								<input type="text" name="name" value="" placeholder="Enter name" />
							</td>
						</tr>
						<tr>
							<td align="center">
								<h3>Price</h3>
							</td>
						</tr>
						<tr>

							<td align="center">
								<input type="text" name="price" value="" placeholder="Enter price" />
							</td>
						</tr>
						<tr>
							<td align="center">
								<h3 style="">Tokens</h3>
							</td>
						</tr>
						<tr>

							<td align="center">
								<input type="text" name="tokens" value="" placeholder="Enter token amount" />
							</td>
						</tr>
						<tr>
							<td align="center" valign="middle">
								<input type="submit" name="pack" value="Add" style="width:100px !important;background-color:#ddd !important;cursor:pointer;" />
							</td>

						</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>


	<div align="center">
		<table width="1010" border="0" cellpadding="5">
			<thead>
				<th align="left">Package name</th>
				<th align="left">Price</th>
				<th align="left">Tokens</th>
			</thead>
			<?php
			$query = mysqli_query($conn, "select * from package order by price asc");
			while ($row = mysqli_fetch_object($query)) {
				echo '<tr class="form_definitions"><td>' . $row->name . '</td><td>$' . $row->price . '</td><td>' . $row->tokens . '  Tokens</td><td><a href="?delete=' . $row->id . '"><div class="" style="font-size:18px;float:right !important;">&#9940;</div></a></td></tr>';
			}
			?>

		</table>
	</div>
	<?php
	include("_footer-admin.php")
	?>