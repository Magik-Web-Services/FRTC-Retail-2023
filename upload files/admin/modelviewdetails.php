<?php
$msg = "";
$tempMoneyEarned = "";
$tempMoneySent = "";
$sitemoney = "";
$tempMoneyEarned30 = "";
//echo "phone chat: ".$_POST['phone_chat'];

if (isset($_POST['Submit3232'])) {
  include('../dbase.php');
  include('../settings.php');
  mysqli_query($conn, "UPDATE chatmodels SET status = 'offline', Spy_Shows = 'no' WHERE user='" . $_POST['username'] . "'");
  mysqli_query($conn, "delete FROM user_logged_in where user='" . $_POST['username'] . "' AND logged_in='yes'");
  mysqli_query($conn, "UPDATE chatmodels set forced_logout='yes' where user='" . $_POST['username'] . "'");
  $msg = "<b style='color:#ff4d07;background-color:#ddd;padding:5px;border-radius:4px;'>Broadcaster Logged out.</b>";
}
if (isset($_POST['phone_chat'])) {
  $phonechat = ", phonechat='yes'";
} else {
  $phonechat = ", phonechat='no'";
}
if (isset($_POST['epc']) && isset($_POST['cpm'])) {
  include('../dbase.php');
  include('../settings.php');
  $page_text = isset($_POST['pay_per_script_html']);
  $page_content = addslashes($page_text);
  mysqli_query($conn, "UPDATE chatmodels SET cpm='$_POST[cpm]',scpm='$_POST[scpm]',epercentage='$_POST[epc]',pay_per_mint_script='$page_text',pay_per_script_html='$page_content' $phonechat WHERE id = '$_POST[id]' LIMIT 1");
}
?>


<?php
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
?>




<?php
include("_header-admin.php")
?>
<?php

//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
//$secondsAll=time();

include('../dbase.php');


$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE id='$_GET[id]' LIMIT 1");
while ($row = mysqli_fetch_array($result)) {
  $tempUser = $row["user"];
  $tempPass1 = $row["password"];
  $tempPass2 = $row["password"];
  $tempEmail = $row["email"];
  $status = $row['status'];
  $tL1 = $row["language1"];
  $tL2 = $row["language2"];
  $tL3 = $row["language3"];
  $tL4 = $row["language4"];

  $tBirthD = $row["birthDate"];
  $tBirthD = GetAge($row["birthDate"]);
  //$birthdateString = date("d F Y,H:i",$row["birthDate"]);
  $birthDateString = $row["birthDate"];


  $tBraS = $row["braSize"];
  $tBirthS = $row["birthSign"];
  $tMessage = $row["message"];
  $tFantasies = $row["fantasies"];
  $tPosition = $row["position"];

  $tEyeC = $row["eyeColor"];
  $tHeight = $row["height"];
  $tWeight = $row["weight"];
  $tHeightM = $row["heightMeasure"];
  $tWeightM = $row["weightMeasure"];

  $cpm = $row["cpm"];
  $scpm = $row["scpm"];
  $epc = $row["epercentage"];

  $pay_per_mint = $row["pay_per_mint_script"];
  $pay_per_script_html = $row["pay_per_script_html"];
  $tCategory = $row["category"];
  $rowdate = $row["dateRegistered"];
  $date = date("d F Y,H:i", $rowdate);
  $tempName = $row["name"];
  $tEthnic = $row["race_ethnicity"];
  $array =  explode(', ', $row['race_ethnicity']);
  //print_r($array);
  $native_language =  $row['native_language'];

  $result3 = mysqli_query($conn, "SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
  while ($row3 = mysqli_fetch_array($result3)) {
    $tempCountry = $row3['name'];
  }

  $tempState = $row["state"];
  $tempZip = $row["zip"];
  $tempCity = $row["city"];
  $tempAdress = $row["adress"];
  $tempPMethod = $row["pMethod"];
  $tempPInfo = $row["pInfo"];
  $tOwner = $row['owner'];
  $tempIdmonth = $row['idmonth'];
  $tempIdyear = $row['idyear'];
  $tempIdtype = $row['idtype'];
  $tempIdnumber = $row['idnumber'];
  $tempSs = $row['ssnumber'];
  $tempPhone = $row['phone'];
  $tempBirth = $row['birthplace'];
  $tempYahoo = $row['yahoo'];
  $tempMsn = $row['msn'];
  $tempIcq = $row['icq'];

  $tHcolor = $row['hairColor'];
  $tHlength = $row['hairLength'];
  $tPhair = $row['pubicHair'];
  $tBfrom = $row['broadcastplace'];
  $tHobbies = $row['hobby'];
  $tempFax = $row['fax'];
  $phonechat = $row['phonechat'];
}
?>

<style type="text/css">
  .selector {
    background-image: url();
    background-color: #FFFFFF;

    position: fixed;

    top: 0;
    left: 0;
    width: 100%;
    height: 40px;
    z-index: 10;

  }


  .wordwrapper {
    min-width: 300px;
    word-wrap: break-word;
    overflow: auto;
  }







  .form_definitions {
    background-color: #f0f0f0;
    color: #fff;
    border: solid;
    border-width: 0.5px;
    border-color: #ccc;
    border-radius: 4px;
    padding: 8px !important;
    margin-bottom: 2px;


  }
</style>



<div align="left">
  <table width="1010" height="70">

    <br>
    <br>
    <br>

    <tr>
      <td>
        <div align="center">
          <h1><?php echo $tempUser; ?></h1>
        </div>
      </td>
    </tr>
  </table>
</div>
<table width="1010" height="214" align="center" cellpadding="20" bgcolor="#FFF" class="form_definitions" style="background-color:#FFF !important;">
  <?php if ($msg != '') { ?>
    <tr>
      <td><?php echo $msg; ?></td>
    </tr>
  <?php } ?>
  <tr>
    <td width="250" height="96" align="center" valign="top">
      <p><img height="200" width="250" src="../models/<?php echo $tempUser . "/thumbnail.jpg" ?>"></p>
    </td>
    <td width="234" valign="top">
      <p style="font-size:20px;"><strong><?php echo $tempUser; ?><br>
          <span class="a_small_title">


            <?php if ($status != 'blocked') {
              echo ' <div style="color:#fff;font-size:20px;font-weight:300;background-color:#789600;border-color:#ddd;border:solid;border-width:0.5px;border-radius:4px;padding:5px;width:245px;margin-left:-296px;z-index:999 !important;position:absolute;margin-top:120px !important;">Account Active &#127916; </div>';
            } else {
              echo ' <div style="color:#fff;font-size:20px;font-weight:300;background-color:#ff2121;border-color:#ddd;border:solid;border-width:0.5px;border-radius:4px;padding:5px;width:245px;margin-left:-296px;z-index:999 !important;position:absolute;margin-top:100px !important;">Account Suspended <br> Pending Review &#128721; </div>';
            }
            ?>

          </span> </strong></p>




      <div calss="wordwrapper">

        <?PHP


        echo '<table border="0" cellspacing="0" cellpadding="0" class="wordwrapper" style="table-layout:fixed" width="130%" height="5%">

  <tr>
    
    <td width="130%" height="5%" class="wordwrapper">' . $tMessage . ' 
    </td>
  </tr>
</table>';


        ?>
      </div>




      <p><strong class="big_title"><br>
        </strong> </p>
    </td>
    <td width="486">
      <div align="left">
        <table width="150" height="96" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <form name="form1" method="post" action="deleteaccount.php">
              <td width="292" height="30">
                <div align="center">
                  <input type="submit" name="Submit2" value="Delete Account" style="cursor:pointer;background-color:#ddd;color:#555;">
                  <input name="id" type="hidden" id="id5" value="<?php echo $_GET['id']; ?>">
                  <input name="type" type="hidden" id="type4" value="model">
                  <input name="username" type="hidden" id="type5" value="<?php echo $tempUser; ?>">
                  <input name="date" type="hidden" id="username" value="<?php echo $date; ?>">
                </div>
              </td>
            </form>
          </tr>
          <tr>
            <?php if ($status != 'blocked') {
              echo ' <form name="form2" method="post" action="blockaccount.php">';
            } else {
              echo ' <form name="form2" method="post" action="activateaccount.php">';
            }
            ?>
            <br>
            <td height="30">
              <div align="center">
                <input type="submit" name="Submit22" value="<?php if ($status != 'blocked') {
                                                              echo ' Suspend Account ';
                                                            } else {
                                                              echo 'Activate Account';
                                                            } ?> " style="cursor:pointer;background-color:#ddd;color:#555;">
                <input name="id" type="hidden" id="id35" value="<?php echo $_GET['id']; ?>">
                <input name="type" type="hidden" id="type" value="model">
                <input name="username" type="hidden" id="username" value="<?php echo $tempUser; ?>">
                <input name="date" type="hidden" id="date23" value="<?php echo $date; ?>">
              </div>
            </td>
            </form>
          </tr>

          <br>

          <tr>
            <form name="form3" method="post" action="sendemail.php">
              <td height="33">
                <div align="center">
                  <input type="submit" name="Submit222" value="Send Email" style="cursor:pointer;background-color:#ddd;color:#555;">
                  <input name="id" type="hidden" id="id45" value="<?php echo $_GET['id']; ?>">
                  <input name="type" type="hidden" id="type2" value="model">
                  <input name="username" type="hidden" id="username4" value="<?php echo $tempUser; ?>">
                  <input name="email" type="hidden" id="date4" value="<?php echo $tempEmail; ?>">
                </div>
              </td>
            </form>
          </tr>

          <br>

          <tr>
            <form name="form3" method="post" action="">
              <td height="33">
                <div align="center">
                  <input type="submit" name="Submit3232" value="Forced Logout" style="cursor:pointer;background-color:#ddd;color:#555;">
                  <input name="id" type="hidden" id="id45" value="<?php echo $_GET['id']; ?>">
                  <input name="type" type="hidden" id="type2" value="model">
                  <input name="username" type="hidden" id="username4" value="<?php echo $tempUser; ?>">
                  <input name="email" type="hidden" id="date4" value="<?php echo $tempEmail; ?>">
                </div>
              </td>
            </form>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
<div align="center">
  <table width="1010" border="0" cellpadding="5">
    <tr>
      <td width="493" style="font-family:Arial, Helvetica, sans-serif;">
        <h1>Broadcaster Details </h1>
      </td>
      <td width="491" style="font-family:Arial, Helvetica, sans-serif;">
        <h1>Broadcaster Private Information</h1>
      </td>
    </tr>
  </table>
</div>
<table width="1010" border="0" align="center" cellpadding="5" cellspacing="1" class="form_definitions">
  <tr>
    <td width="471" valign="top" bgcolor="#FFFFFF">
      <table width="100%" border="0" align="center" cellpadding="5px" cellspacing="2">
        <tr>
          <td width="133" height="19" align="left" valign="top"><strong>User Name</strong></td>
          <td width="501" align="left" valign="top" class=""><strong><?php echo $tempUser; ?></strong></td>
        </tr>
        <tr>
          <td align="left" valign="top" class="" bgcolor="#f0f0f0">Email</td>
          <td align="left" valign="top" class="" bgcolor="#f0f0f0"><?php echo $tempEmail; ?></td>
        </tr>

        <tr>
          <td align="left" valign="top" class="">Language</td>
          <td align="left" valign="top" class=""><?php echo $native_language; ?>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top" class="" bgcolor="#f0f0f0">Race</td>
          <td align="left" valign="top" class="" bgcolor="#f0f0f0"><?php echo $tEthnic;   ?></td>
        </tr>
      </table>
    </td>
    <td width="516" valign="top">
      <div align="center">
        <table width="100%" border="0" cellpadding="5" cellspacing="2">
          <tr>
            <td width="179" align="left" valign="top" class="" bgcolor="#fff">Full Name:</td>
            <td width="311" align="left" valign="top" class="" bgcolor="#fff"><?php echo $tempName; ?></td>
          </tr>
          <tr>
            <td width="179" align="left" valign="top" class="">Country:</td>
            <td align="left" valign="top" class=""><?php echo $tempCountry; ?></td>
          </tr>
          <tr>
            <td width="179" align="left" valign="top" class="" bgcolor="#fff">State:</td>
            <td align="left" valign="top" class="" bgcolor="#fff"><?php echo $tempState; ?></td>
          </tr>
          <tr>
            <td width="179" height="21" align="left" valign="top" class="">City:</td>
            <td align="left" valign="top" class=""><?php echo $tempCity; ?></td>
          </tr>
          <tr>
            <td width="179" align="left" valign="top" class="" bgcolor="#fff">Adress:</td>
            <td align="left" valign="top" class="" bgcolor="#fff"><?php echo $tempAdress; ?></td>
          </tr>
          <tr>
            <td width="179" align="left" valign="top" class="">Zip Code:</td>
            <td align="left" valign="top" class=""><?php echo $tempZip; ?></td>
          </tr>
          <tr class="">
            <td width="179" align="left" bgcolor="#fff">Phone#:</td>
            <td bgcolor="#fff"><?php echo $tempPhone; ?></td>
          </tr>
          <tr>
            <td align="left" class="">Age:</td>
            <td align="left" class=""><?php echo $tBirthD; ?></td>
          </tr>
          <tr>
            <td align="left" class="" bgcolor="#fff">Birth Date:</td>
            <td align="left" class="" bgcolor="#fff"><?= $birthDateString ?></td>
          <tr>
            <td width="179" align="left" class="">Date Registered: </td>
            <td align="left" class=""><?php echo $date; ?> </td>
          </tr>
        </table>
      </div>
      <div align="center"></div>
    </td>
  </tr>
</table>
<form name="form1" method="post" action="">
  <table width="1010" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#F2F2F2" class="form_definitions">
    <tr>
      <td bgcolor="#F2F2F2">
        <p> Earning percentage. <br>
          <input name="epc" type="text" id="epc" value="<?php echo $epc; ?>" size="2" maxlength="2" style="width:25%;">
          <br>
          <br />
          Cost Per minute<br>
          <input name="cpm" type="text" id="cpm4" value="<?php echo $cpm; ?>" size="4" maxlength="4" style="width:25%;">
          Now Charging (<?php echo $cpm ?> Tokens per minute) <br>
          <br />
          <br />
          Spectator Cost Per minute<br>
          <input name="scpm" type="text" id="cpm4" value="<?php echo $scpm; ?>" size="4" maxlength="4" style="width:25%;">
          Now Charging (<?php echo $scpm ?> Tokens per minute) <br>
          <br />

        <div style="position:absolute;margin-left:0px;margin-top:-8px;"><input type="checkbox" name="phone_chat" id="phone_chat" <?php if ($phonechat == "yes") {
                                                                                                                                    echo "checked='checked'";
                                                                                                                                  } ?>> Display Featured Broadcaster Icon </div>
        </br>
        <br />
        <input type="submit" name="Submit" value="   Save   " class="form_definitions" style="width:350px;background-color:#FFF;color:#555;cursor:pointer;">
        <input name="id" type="hidden" id="id4" value="<?php echo $_GET['id']; ?>">
        </p>
      </td>
    </tr>
  </table>
</form>
<p>
  <?php
  $result = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$tempUser' ORDER BY date DESC");
  if (isset($_POST['vs'])) {
    $result = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$tempUser' AND member like '%$_POST[vs]%' ORDER BY date DESC");
  }
  $total = mysqli_num_rows($result);
  $perpage = 35;
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }
  $start = ($page - 1) * $perpage;
  if (isset($_POST['vs'])) {
    $result = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$tempUser' ORDER BY date DESC LIMIT $start,$perpage");
  }
  echo '<table width="1200px"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
<tr><td width="100px"><form method="post" action=""><input style="width:300px;" type="text" name="vs" placeholder="Search by name..."/> <input class="form_definitions" style="width:300px;margin-left:320px;margin-top:-52px !important;color:#5b5b5b;cursor:pointer;" type="submit" value=" Search "/></form></td></tr>



<tr width="100px" style="background-color:#e8e8e8;"><td style="color:#ff00bc;">Member</td><td style="color:#ff00bc;">Date</td><td style="color:#ff00bc;">Duration</td><td style="color:#ff00bc;">CPM</td><td style="color:#ff00bc;">Earned</td><td style="color:#ff00bc;">Type</td></tr>';

  while ($row = mysqli_fetch_array($result)) {
    echo "<tr class='form_definitions'><td>$row[member]</td><td>" . date("d M Y, G:i:s", $row['date']) . "</td><td>" . (($row['type'] == 'show') ? "$row[duration] seconds" : "NA") . "</td><td>$row[cpm] tokens</td><td>$" . (($row['type'] == 'show') ? round((($row['duration'] / 60) * $row['cpm']) * ($row['epercentage'] / 100), 1) : round(($row['cpm']) * ($row['epercentage'] / 100), 1)) . "</td><td>$row[type]</td></tr>";
  }
  if (isset($_POST['vs'])) {
    if ($total) {
      $pages = range(1, ceil($total / $perpage));
      echo "<tr><td>";
      foreach ($pages as $pagez) {
        if ($pagez == $page) {
          echo "<b>$pagez</b>";
          echo  " ";
        } else {
          echo "<a href=\"$_SERVER[REQUEST_URI]&page=$pagez\">$pagez</a>";
          echo  " ";
        }
      }
      echo "</td></tr>";
    }
  }
  echo '</table>';
  ?>
</p>
<p>


  <?
  $tempMinutesPv = 0;
  $tempSecondsPv = 0;
  $sitemoney = 0;
  $tempMoneyEarned = 0;
  $tempMoneySent = 0;
  $tempMoneyEarned30 = 0;
  $ammount = 0;
  $result = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$tempUser'");
  while ($row = mysqli_fetch_array($result)) {
    $member = $row['member'];
    $epercentage = $row['epercentage'];
    $duration = $row['duration'];
    $cpm = $row['cpm'];
    $scpm = $row['scpm'];
    $tempSecondsPv += $row['duration'];
    if ($row['type'] == 'show') {
      $ammount = (($duration / 60) * $cpm) * ($epercentage / 100);
      $sitemoney +=   (($duration / 60) * $cpm)  * ((100 - $epercentage) / 100);
    } else {
      $ammount = ($cpm) * ($epercentage / 100);
      $sitemoney += ($cpm) *  ((100 - $epercentage) / 100);
    }

    $tempMoneyEarned += $ammount;

    if (time() - 604800 < $row['date']) {
      $tempMoneyEarned30 += $ammount;
    }
    if ($row['paid'] == "1") {
      $tempMoneySent += $ammount;
    }
  }
  mysqli_free_result($result);
  ?>
</p>
<table width="1200" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">
  <tr>
    <td bgcolor="#ffffff" class="small_title">
      <p class="message"><span class="message">Funds earned total: $<?php echo $tempMoneyEarned; ?></span><br>
        Site funds earned from Performer total: $<?php echo $sitemoney; ?><br>
        Funds not yet paid: $<?php echo intval($tempMoneyEarned) - intval($tempMoneySent) ?><br>
        Funds earned by Performer in last 7 days: $<?php echo $tempMoneyEarned30; ?></p>
    </td>
  </tr>
</table>
<table width="1200" align="center" bgcolor="#ffffff" class="form_definitions" style="background-color:#eee !important;">
  <tr>
    <td><strong class="a_small_title">Copy of <?php echo $tempName; ?>'s photo ID </strong></td>
  </tr>
  <tr>
    <td><img src="../models/<?php echo $tempUser . "/" . $_GET['id'] . ".jpg";  ?>" width="50%"></td>
  </tr>
</table>
<br />
<table width="1200" align="center" bgcolor="#ffffff" class="form_definitions" style="background-color:#eee !important;">
  <tr>
    <td><strong class="a_small_title">Recorded photo of <?php echo $tempName; ?> </strong></td>
  </tr>
  <tr>
    <td><img src="../models/<?php echo $tempUser . "/representative.jpg";  ?>" width="50%"></td>
  </tr>
</table>



<?php
include("_footer-admin.php")
?>