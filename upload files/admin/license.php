  <?
include("_header-admin.php")
?>


<style type="text/css">
<!--


.selector
{
  background-image: url();
  background-color: #FFFFFF;
  
  position: fixed;
  
  top: 0;
  left: 0;
  width: 100%;
  height: 50px;
  z-index: 10;

}
-->

</style>

<?php
include('../dbase.php');
include('../settings.php');

if($_POST['license_key'])
{
$key=$_POST['license_key'];
mysql_query("update setting set value='$key' where type='license_key' ");
}

$row=mysql_fetch_assoc(mysql_query("select value from setting where type='license_key' "));
?>


<br><br><br><br><br><br><br><br>
<div align="center">
<form name="form1" method="post" action="">

        <h1>Product Activation</h1>
        <p>This product requires a valid license. Please enter your license key in the field below and save.  </p>
        <table   border="0" bgcolor="#ffffff">
      <tr>
        <td class="big_title">&nbsp;</td>
      </tr>
      <tr>
        <td class="big_title">License key:          
          <input name="license_key" type="text" id="license_key" size="100" maxlength="32" value="<?=$row['value'];?>"></td>
      </tr>
   <tr>
          <td><input type="submit" name="Submit" value="Save"></td>
      </tr>
    </table>	
</form>
</div>
<?
include("_footer-admin.php")
?>

