<?
include("_main.header.php");
require_once("dbase.php");
?>
<?

	if(isset($_POST['submit']))
	{
		$msg = ""; 
		$model_name = $_POST['search']; 
		$query = "SELECT * FROM chatmodels where user like '%".$model_name."%'";
		$result = mysql_query($query) or die( mysql_error()); 
		$num = mysql_num_rows($result) ; 
		if($num > 0 ) 
		{
			$msg .= "<table>";
			$msg .= "<tr>";
			////////////
			////////////
			for($counter=0; $counter<$num; ++$counter)
			{
				$img_Name = mysql_result($result,$counter,'tImage');
				$user_Name = mysql_result($result,$counter,'user');			
				$status = mysql_result($result,$counter,'status'); 

				if(($counter)/6 == 1 ) 
				{
					$msg .='<tr>';
					$msg .= '<td width="115" height="222" align="center" valign="middle" background="images/search_model_box_ie.png">';
					$msg .= '<table width="115" height="211" border="0" cellpadding="0" cellspacing="0">';
					$msg .= '<tr>';
					$msg .= '<td height=90 align="center" valign="middle"><a href="liveshow.php?model='.$user_Name.'"><img src="models/'.$user_Name.'/thumbnail.jpg" width="98" height="86" border="0"></td>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="liveshow.php?model='.$user_Name .'">'.$user_Name .'</a></span></td>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="gallery.php?user='.$username .'">PICTURE GALLERY</a></span></td>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="videos.php?model='.$user_Name .'">VIDEO GALLERY</a></span></td>';
					$msg .= '</tr><tr>';
					$msg .= '<td height=20 align="center" valign="top">';
					$msg .= '<span class="model_title_small">';
					$msg .= '<span class="model_message"><a href="liveshow.php?model='.$user_Name .'">FREE CHAT</a></span><br>';
					
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title">'.$status.'</span></td>';
					$msg .= '</tr></table>';
					$msg .=   '  </td>';
					
					$msg .='</tr>';
				}
				else
				{
					$msg .= '<td width="115" height="222" align="center" valign="middle" background="images/search_model_box_ie.png">';
					$msg .= '<table width="115" height="211" border="0" cellpadding="0" cellspacing="0">';
					$msg .= '<tr>';
					$msg .= '<td height=90 align="center" valign="middle"><a href="liveshow.php?model='.$user_Name.'"><img src="models/'.$user_Name.'/thumbnail.jpg" width="98" height="86" border="0"></td>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="liveshow.php?model='.$user_Name .'">'.$user_Name .'</a></span></td>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="gallery.php?user='.$username .'">PICTURE GALLERY</a></span></td>';
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="videos.php?model='.$user_Name .'">VIDEO GALLERY</a></span></td>';
					$msg .= '</tr><tr>';
					$msg .= '<td height=20 align="center" valign="top">';
					$msg .= '<span class="model_title_small">';
					$msg .= '<span class="model_message"><a href="liveshow.php?model='.$user_Name .'">FREE CHAT</a></span><br>';
					
					$msg .= '</tr><tr>';
					$msg .= '<tr>';
					$msg .= '<td height=20 align="center" valign="top"><span class="modelbox_title">'.$status.'</span></td>';
					$msg .= '</tr></table>';
					$msg .=   '  </td>';
				}

			}
			$msg .= "</tr>";			
			$msg .= "</table>";
		}
		else
		{
			$msg = "No data Found" ; 
		}
	}
?>


			
<style type="text/css">
<!--

input{color:#ffffff}  
input{background-color:#333333}
input{border-color: black}

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
	color: #FFCC00;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
-->
</style>


<table width="100%" height="38" border="0" align="center" bgcolor="#8F0000">
  <tr>
  <td align="center"><h4 class="style1">&nbsp;</h4>
    <form method="post" action="<? echo $PHP_SELF ?>">
      &nbsp;
      <table width="720" height="120" border="0" cellpadding="0" cellspacing="0" background="images/search_models_search_bg.png">
        <tr>
          <td><div align="center">
              <p>&nbsp;</p>
            <p><span class="style4">Search by name</span>&nbsp;&nbsp;&nbsp;
                  <input type="text" name="search"/>
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
	
	
	<? echo $msg; ?>
	

    </p>
    <p></p>
    <p><br />
    </p>    </td>
  </tr>
</table>  
  <?
include("_main.footer.php");
?>

