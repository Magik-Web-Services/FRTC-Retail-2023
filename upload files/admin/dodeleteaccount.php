<?
error_reporting(0);
include ("../dbase.php");
include ("../settings.php");
if ($_GET['type']=="model"){
mysql_query('DELETE from modelpictures WHERE user="'.$_GET['username'].'"');
mysql_query('DELETE from chatmodels WHERE user="'.$_GET['username'].'"');
mysql_query('DELETE from favorites WHERE model="'.$_GET['username'].'"');
//unlink("../models/".$_GET['username']."/");
$dir="../models/".$_GET[username]."/";
$files=scandir($dir);
foreach($files as $file)
{
if(strlen($file)>2)
{
unlink($dir.$file);
}
}
rmdir($dir);
} else if($_GET['type']=="member"){
mysql_query('DELETE from chatusers WHERE user="'.$_GET['username'].'" ');
mysql_query('DELETE from favorites WHERE member="'.$_GET['username'].'"');
}
else if ($_GET['type']=="sop"){
mysql_query('DELETE from chatoperators WHERE user="'.$_GET['username'].'"');
}

?>
<?
include("_header-admin.php")
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F8F8F8">
  <tr>
    <td bgcolor="#F8F8F8"><p>&nbsp;</p>
      <table width="600"  border="0" align="center">
        <tr>
          <td width="590" class="big_title"><div align="left">
            <p align="center"><b><h1 align="center">Account Deleted</h1>
            <p align="center"><a href="index.php">Return to Admin Panel</a></p>
            </b><br>
              </p>
            </div></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
