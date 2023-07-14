<?php
$tempEPercentage = "";
$tempCPM = "";
$tempMinimum = "";
$tempSCPM = "";

if (isset($_POST['resettoken'])) {
  include("../../dbase.php");
  include("../../settings.php");
  $idd = $_COOKIE["id"];
  $result = mysqli_query($conn, "SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");
  $row = mysqli_fetch_array($result);
  $username = $row['user'];
  mysqli_query($conn, "DELETE FROM videosessions_copy WHERE model='$username'");
  mysqli_query($conn, "UPDATE chatmodels SET tipgoal='0' WHERE user = '$username'");
  $msg = "<b style='color: green; margin-top: 20px; float: left; margin-bottom: 10px;'>Token Goal reset successfully.</b>";
}
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype'] != "chatmodels") {
  header("location: ../../login.php");
} else {
  include("../../dbase.php");
  include("../../settings.php");
  $result = mysqli_query($conn, "SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");
  while ($row = mysqli_fetch_array($result)) {
    $username = $row['user'];
  }
}

mysqli_free_result($result);
$welcomeQuery = "SELECT models FROM welcome";
$resultModel = mysqli_query($conn, $welcomeQuery);
$chkN = mysqli_num_rows($resultModel);
if ($chkN > 0) {
  // $valueWM = mysqli_result($resultModel,0,'models'); 
  $valueWM = $resultModel->fetch_assoc()['blah'] ?? false;
} else {
  $valueWM = "Welcome text not defined";
}
$msgError = "";
include("../../dbase.php");
include("../../settings.php");
$id = $_COOKIE["id"];
$model = $username;
if (isset($_POST['paymentSum'])) {
  $cpm = $_POST['cpm'];
  $scpm = $_POST['scpm'];
  $tipgoal = $_POST['tipgoal'];
  mysqli_query($conn, "UPDATE chatmodels SET minimum='$_POST[paymentSum]',cpm='$cpm',scpm='$scpm',tipgoal='$tipgoal' WHERE id = '$id' LIMIT 1");
  $msgError = "<div style='color:#fb41b5;'>Change Successful</div>";
}

include("_models.header.php");
include("../../settings.php");

$tempMinutesPv = 0;
$tempSecondsPv = 0;
$tempMoneyEarned = 0;
$tempMoneySent = 0;
$ammount = 0;
$result = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$model'");
while ($row = mysqli_fetch_array($result)) {
  $member = $row['member'];
  $epercentage = $row['epercentage'];
  $duration = $row['duration'];
  $cpm = $row['cpm'];
  $tempSecondsPv += $row['duration'];
  if ($row['type'] == 'show') {
    $ammount = round((($duration / 60) * $cpm) * ($epercentage / 100), 2);
  } else {
    $ammount = round($cpm * ($epercentage / 100), 2);
  }
  $tempMoneyEarned += $ammount;
  if ($row['paid'] == "1") {
    $tempMoneySent += $ammount;
  }
}
mysqli_free_result($result);
$result = mysqli_query($conn, "SELECT lovense,user FROM chatmodels WHERE id='" . $id . "' LIMIT 1");
while ($row = mysqli_fetch_array($result)) {
  $lovense = $row["lovense"];
  $un = $row["user"];
}
mysqli_free_result($result);
?>
<style>
  input.resettoken {
    border: 0px;
    margin-bottom: 10px;
    background-color: #fb41b5;
    color: #fff;
    padding: 5px 9px;
  }
</style>
<div class="main-container-cllss">
  <?php
  if ($lovense == null) {
    $array = [];

    // $array['dToken']='xNya9rzJS+vG5pfajsd890fsdf9wfjshkfs;jksjgjklahgakj;ncosdYHTYFvDo2ERQXUuq'; //

    // Lovense devloper token var comes from settings.php //
    $array['dToken'] = "$lovenseDevID";



    $array['mInfo'] = json_encode(array('mId' => $un, 'mName' => $un));

    $curl = curl_init('https://api.lovense.com/api/cam/model/getToken');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("User-Agent: Mozilla/5.0 (Linux; Android 5.0.2; XT1068 Build/LXB22.99-16) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.93 Mobile Safari/537.36"));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($array));
    $response = curl_exec($curl);
    $code = curl_getinfo($curl);
    curl_close($curl);

    $a = json_decode($response);
    $lovense = $a;
    mysqli_query($conn, "UPDATE chatmodels set lovense='$lovense' WHERE user='$un'; ");
  }

  echo '<iframe src="https://api.lovense.com/api/cam/model/setting?mToken=' . $lovense . '"
 marginwidth="0"
 marginheight="0"
 hspace="0"
 vspace="0"
  width="100%" height="1020"
 frameborder="0"
 scrolling="no"></iframe>';

  ?>
</div>
<td height="113" class="form_definitions">

  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

    <ul id="css3menu1" class="topmenu">
      <li class="topmenu"><a href="paymentop.php" style="height:10px;line-height:10px;">View Payments</a></li>
      <li class="topmenu"><a href="showslist.php" style="height:10px;line-height:10px;">View Show History</a></li>


      </tr>

  </table>

  <br>

  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">

    <tr>

      <td colspan="2" align="left" valign="top">

        <p class="error"><strong>

            <?php

            if (isset($msgError) && $msgError != "") {

              echo $msgError;
            }

            ?>

        </p>

        <p class="form_definitions">

          <strong>You are currently receiving <?php echo $tempEPercentage; ?>% of your earnings.<br>

            You are currently charging <?php echo $tempCPM; ?> Tokens

            per minute.</strong>
        </p>
        <p class="form_definitions"><strong><br />
          </strong></p>
      </td>
    </tr>

    <tr>

      <td width="50%" height="120" align="left" valign="top">Your earnings: $<?php echo $tempMoneyEarned; ?><br>

        Payouts so far: $<?php echo $tempMoneySent; ?><br>

        <b> Current account balance: $<?php echo ($tempMoneyEarned - $tempMoneySent); ?></b>
      </td>

      <td width="50%" height="120" align="left" valign="bottom">
      </td>
    </tr>

    <tr>

      <td colspan="2" align="left" valign="top">
        <form name="form1" method="post" action="paymentop.php">

          <p align="left">$ <select name="paymentSum" id="paymentSum">
              <option value="100" <?php if ($tempMinimum == "100") {
                                    echo "selected";
                                  } ?>>100</option>
              <option value="250" <?php if ($tempMinimum == "250") {
                                    echo "selected";
                                  } ?>>250</option>
              <option value="500" <?php if ($tempMinimum == "500") {
                                    echo "selected";
                                  } ?>>500</option>
              <option value="1000" <?php if ($tempMinimum == "1000") {
                                      echo "selected";
                                    } ?>>1000</option>
              <option value="2500" <?php if ($tempMinimum == "2500") {
                                      echo "selected";
                                    } ?>>2500</option>
              <option value="5000" <?php if ($tempMinimum == "5000") {
                                      echo "selected";
                                    } ?>>5000</option>
            </select>
            &nbsp;Minimum Payout Goal.</p>
          <p align="left">
            &nbsp;&nbsp;
            <input size="5" name="cpm" value="<?= ($tempCPM); ?>">
            &nbsp;Tokens Per Minute.
          </p>
          <p align="left">
            &nbsp;&nbsp;
            <input size="5" name="scpm" value="<?= ($tempSCPM); ?>">
            &nbsp;Spectator Tokens Per Minute.
          </p>
          <p align="left">
            &nbsp;&nbsp;<input name="image" type="image" src="../../images/update-btn.png" alt="" width="99" height="52" border="0" />
          </p>

        </form>
      </td>
    </tr>
  </table>
  <p><strong>Previous Payouts</strong></p>

  <p> <?php




      include('../../dbase.php');

      $count = 0;

      $result = mysqli_query($conn, "SELECT * FROM payments WHERE id='$id' ORDER BY date DESC");

      while ($row = mysqli_fetch_array($result)) {

        $count++;

        $ammount = $row['ammount'];

        echo '<table class="form_definitions" width="1223" bgcolor="#8F0000" border="0" align="center" cellpadding="2" cellspacing="1">

		<tr>

		<td class="barbg">' . $count . ') <b>Amount: $' . $ammount . '</b> sent on ' . date("d M Y, G:i", $row['date']) . '</td>

		</tr> 

		<tr>

		<td class="tablebg"><p><b>Payout Method:</b> ' . $row['method'] . '<br><b>Payout Information: </b>' . $row['details'] . '</p></td>

		</tr>

		</table>

		<br>';
      }

      mysqli_free_result($result);

      ?>

  </p>
</td>

</tr>

</table>

<div id="Layer1">
  <h2>Site information & latest news.</h2>
  <h3>
    <?php
    echo $valueWM;
    ?>
  </h3>
  </div? <?php
          include("_models.footer.php");
          ?>