<?
include("_main.header.php");
require_once("dbase.php");
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type='text/javascript' src='/js/jquery.lazyload.min.js'></script>
<script>
$(document).ready(function() {
$("img.lazy").lazyload({effect : "fadeIn",effectspeed: 500 });
$('.showThumbnail').live('mouseenter', function() {
      $(this).find(':first-child').css('display', 'none');

      var hiddenDiv = $(this).find(':last-child');

      var iFrameHtml = hiddenDiv.html();

      if (iFrameHtml.indexOf('iframe') == -1) {

      	var username = $(this).attr('rel');

      	hiddenDiv.html('<iframe width="250" height="200" src="thumbnail.php?model='+username+'" scrolling="no" frameborder="0"  allowfullscreen></iframe>');

      }

      hiddenDiv.css('display', 'block');
    });

	$('.showThumbnail').live('mouseleave', function() {
      var hiddenDiv = $(this).find(':last-child');

      hiddenDiv.css('display', 'none');

      hiddenDiv.html('');

      $(this).find(':first-child').css('display', 'block');
	});
});
</script>


<style type="text/css">
<!--


.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style4 {font-size: 12px}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	font-weight: bold;
}
body {
	background-color: #8F0000;
}
a {
	font-size: 11px;
	color: #FFFFFF;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: none;
	color: #ECE9D8;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
-->
</style>


<!--<table width="100%" height="38" border="0" align="center" bgcolor="#8F0000">
  <tr>
  <td align="center"><h4 class="style1">&nbsp;</h4>
    <form method="post" action="<?php echo $PHP_SELF ?>">
      &nbsp;
      <table width="720" height="120" border="0" cellpadding="0" cellspacing="0" background="images/search_models_search_bg.png">
        <tr>
          <td><div align="center">
            <p>&nbsp;</p>
            <p><span class="style4">Search by name</span>&nbsp;&nbsp;&nbsp;
              <input type="text" name="search" value="<?=$_POST[search];?>"/>
&nbsp;
<input type="submit" name="submit" value="Search" />
<br />
<br />
<br />
            </p>
            </div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>  </td>
  </tr>
  <tr>
  <td align="center">
    <p>
      <?	echo $msg; ?>
    </p>
    <p>&nbsp;</p>
    <p><br />
    </p>    </td>
  </tr>
</table>-->
<br/><br/><br/><br/><br/>
<table border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#8F0000">
<?php
$model=htmlentities($_POST[search]);

//echo "SELECT * FROM chatmodels  WHERE user like '%$model%' AND status!='rejected' AND status!='blocked' AND status!='pending' ";
if($model)
{
$result = mysql_query("SELECT * FROM chatmodels  WHERE user like '%$model%' AND status!='rejected' AND status!='blocked' AND status!='pending' ");
$count==0;
while($row = mysql_fetch_array($result)) 
{
    
    //echo "<pre>"; print_r($row);
   //echo  $row['user'];
$count++;
if($count==1) { echo '<tr>'; }
echo '
<td height="200" align="center" valign="middle" >
<table border="0" cellpadding="0" cellspacing="2">
<tr><td height="200" align="center" valign="middle"><a class="showThumbnail" href="liveshow.php?model='.$row["user"].'" rel="'.$row["user"].'"><img class="lazy" src="models/'.$row["user"].'/thumbnail.jpg" data-original="models/'.$row["user"].'/thumbnail.jpg" width="250" height="200" border="0"><div style="display:block"></div></a></td></tr>
<tr><td height="30" align="center" valign="middle"><span class="modelbox_title"><a href="liveshow.php?model='.$row["user"].'">'.$row["user"].'</a></span></td></tr>
</table>
</td>';


if($count==5) { $count=0;echo '</tr>'; }
}
}
?>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

       <?
include("_main.footer.php");
?>
