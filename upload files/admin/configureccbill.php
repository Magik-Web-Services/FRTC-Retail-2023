<?php
include("_header-admin.php");
?>

<?php


include('../dbase.php');
if (isset($_POST['btnSubmit']) != "") {
  $sql = "Update payccbill set act = '" . $_POST['act'] . "',subact = '" . $_POST['subact'] . "',frmname = '" . $_POST['frmname'] . "',codtxt = '" . $_POST['codtxt'] . "' where code ='1'";
  $res = mysqli_query($conn, $sql);
}

$sql = "select * from payccbill where code='1'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>

<form action="" method="POST" onsubmit="return check();">

  <div align="center">
    <table width="50%" border="0">
      <tr>
        <td>
          <div align="center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <h1>CC Bill Payment Gateway Configuration <br />
            </h1>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <table width="50%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">
    <tr>
      <td bgcolor="#ffffff" class="form_definitions">
        <p align="center">Enter your CC Bill account information in the fields below and save.
        <p align="center"><br>
          Account Number<br />
          <input type="text" name="act" id="act" value="<?= $row['act'] ?>" size="60" />
      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" class="form_definitions">
        <p align="center"><br>
          Sub-Account Number<br />
          <input type="text" name="subact" id="subact" value="<?= $row['subact'] ?>" size="60" />

      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" class="form_definitions">
        <p align="center"><br>
          Form Code <br />
          <input type="text" name="frmname" id="frmname" value="<?= $row['frmname'] ?>" size="60" />

      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" class="form_definitions">
        <p align="center"><br>
          Main Code<br />
          <input type="text" name="codtxt" id="codtxt" value="<?= $row['codtxt'] ?>" size="60" />

      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" class="form_definitions">
        <p align="center"><br>
          <input type="submit" value=" Save " name="btnSubmit" style="width:20% !important;background-color:#ddd !important;cursor:pointer;" />

      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" class="form_definitions"><a href="http://ccbill.com" target="_blank"><img src="images/CC-BILL-LOGO.png" rel="nofollow" alt="CC Bill Payment System By: Camscripts.com" width="95" height="109" border="0" /></a></td>
    </tr>
  </table>
</form>
<script language="javascript" type="text/javascript">
  function check() {
    if (document.getElementById('act').value == "") {
      alert("Please enter account name.");
      document.getElementById('act').focus();
      return false;
    }
    if (document.getElementById('subact').value == "") {
      alert("Please enter sub-account name.");
      document.getElementById('subact').focus();
      return false;
    }
    if (document.getElementById('frmname').value == "") {
      alert("Please enter form name.");
      document.getElementById('frmname').focus();
      return false;
    }
    if (document.getElementById('codtxt').value == "") {
      alert("Please enter code.");
      document.getElementById('codtxt').focus();
      return false;
    }
    return true;
  }
</script>
<?php
include("_footer-admin.php")
?>