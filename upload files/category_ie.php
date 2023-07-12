<?
include("_main.header.php");

$models_per_page = 24;		// never make this 0, never
$max_page_show = 15;			

	  if (!isset($_GET['page']))
	  {
		$page=1;
		$query_add = " limit ".($page-1).", $models_per_page";
	  }
	  else
	  {	
		$page = $_GET['page'];
		$query_add = " limit ".(($page-1)*$models_per_page).",$models_per_page";
	  }
	  
	$select="SELECT * FROM chatmodels WHERE 1" ;
	
	$result = mysql_query($select);

	$nTotal=mysql_num_rows($result);

	mysql_free_result($result);

	if ($max_page_show >= $nTotal)
	{
		$start_from = 1;
		$loop_till = ceil($nTotal/$models_per_page);
	}
	else
	{
		if ($page > $max_page_show)
		{
			$start_from = $page;
		}
		else
		{
			$start_from = 1;
		}
		$loop_till = ($max_page_show+$page);
	}
	
?>

<style type="text/css">
<!--
body,td,th {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
body {
	background-color: #8F0000;
	margin-left: 0px;
	margin-right: 0px;
}
a:link {
	color: #FFFFFF;
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
.style2 {font-size: 14px}
.style3 {font-size: 14}
.style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFCC00;
}
a {
	font-size: 11px;
}
-->

</style>

<div align="center"><br />
  <table width="720" height="129" border="0" cellpadding="0" cellspacing="0" bgcolor="#8F0000">
    <tr>
      <td background="images/category_bar1.png"><p align="center"><br />
      </p>
        <table width="720" height="56" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="18" height="18">            </td>
            <td width="165"><a href="category_ie.php?category=Girl">Girls</a></td>
            <td width="173"><a href="category_ie.php?category=Lesbians">Lesbians</a></td>
            <td width="167"><a href="category_ie.php?category=Mature Female">Mature Female</a></td>
            <td width="197"><a href="category_ie.php?category=Couple">Couples</a></td>
          </tr>
          <tr>
            <td><br /></td>
            <td><a href="category_ie.php?category=Group">Group</a></td>
            <td><a href="category_ie.php?category=Fetish">Fetish</a></td>
            <td><a href="category_ie.php?category=Boy">Boys</a></td>
            <td><a href="category_ie.php?category=Gay">Gay</a></td>
          </tr>
          <tr>
            <td height="18"><br /></td>
            <td><a href="category_ie.php?category=Transgendered">Transgendered</a></td>
            <td><a href="category_ie.php?category=Making Friends">Making Friends</a></td>
            <td><a href="category_ie.php?category=Romance">Romance</a></td>
            <td><a href="category_ie.php?category=Nasty Words">Nasty Words</a></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000">
<tr>
  <td height="18" bgcolor="#8F0000">
</tr>
</table>

<table width="720" height="34" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000">

  <tr>

    <td height="24" align="center" background="images/page_red_bar.png" class="form_definitions"><div align="right"><span class="style2">Page: <?
			if ($page > 1)
			{
		?>
          <span class="style3">&nbsp; <a href="index_ie.php?page=<?=($page-1)?>" target="_self">Previous</a> </span>
          <?php
			}
		?>
          <?
			for ($i=$start_from; $i<=$loop_till ;$i++)
			{
		?>
          <span class="style3">&nbsp; <a href="index_ie.php?page=<?=$i?>" target="_self">
          <? if ($i==$page) {echo "<font color='white'><b>";} echo $i; if ($i==$page) {echo "</b></font>";} ?>
          </a> </span>
          <?
			}
			if ($page < $loop_till)
			{
		?>
          <span class="style3">&nbsp; <a href="index_ie.php?page=<?=$page+1?>" target="_self">Next</a> </span>
          <?php
			}
		?>
    </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
  </tr>
</table>

<br />
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000">

  <tr>

    <td align="center" valign="top"><?php echo '<table width="720" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#8F0000">';



		    $count=0;

			$nTime=time();

			

			

			if (!isset($_GET['category']))

			{

			$select="SELECT * FROM chatmodels WHERE status='online'".$query_add;//100hours

			} else{

			$select="SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='online'".$query_add;

			}

						

			

			$result = mysql_query($select);

			while($row = mysql_fetch_array($result)) 

				{			
				

				$tBirthD=$row[birthDate];

				$nYears=date('Y',time()-$tBirthD)-1970;

					

				$username=$row[user];

				$tempMessage=$row[message];

				$tempCity=$row[city];

				$tempPlace=$row[broadcastplace];

				$tempL1=$row[language1];

				$tempL2=$row[language2];
				
				$status=$row[status];
				
					
	



					

				

			

				$count++;

				if ($count==1) {echo' <tr>';}

				echo '<td width="115" height="222" align="center" valign="middle" background="images/modelbox_red_v2_2.png">';

  				echo '<table width="115" height="211" border="0" cellpadding="0" cellspacing="0">';
				
	 			echo '<tr>';
				
				echo '<td height=70 align="center" valign="middle"><a href="liveshow.php?model='.$username.'"><img src="models/'.$username.'/thumbnail.jpg" width="99" height="86" border="0"></td>';

				echo '</tr><tr>';
				
				echo '<tr>';
				
                echo '<td height=23 align="center" valign="top"><span class="modelbox_title"><a href="liveshow.php?model='.$username .'">'.$username .'</a></span></td>';
		 		
			    echo '</tr><tr>';
				
				echo '<tr>';
				
                echo '<td height=18 align="center" valign="top"><span class="modelbox_title"><a href="ladydetails.php?user='.$username .'">BIO</a></span></td>';
		 		
			    echo '</tr><tr>';
				
				echo '<tr>';
				
                echo '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="gallery.php?user='.$username .'">PICTURE GALLERY</a></span></td>';
		 		
			    echo '</tr><tr>';

	 			echo '<tr>';
				
                echo '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="videos.php?model='.$username .'">VIDEO GALLERY</a></span></td>';
		 		
			    echo '</tr><tr>';

		      	echo '<td height=20 align="center" valign="top">';

		        echo '<span class="model_title_small">';

				echo '<span class="model_message"><a href="liveshow.php?model='.$username .'">FREE CHAT</a></span><br>';

		        	//echo '<span class="model_message">&nbsp&nbsp&nbsp&nbsp&nbsp'.$tempMessage.'</span></td>';

				echo '</tr></table>';

				echo '  </td>';

				if ($count==6){ echo"</tr>"; $count=0;}

				}

			



			if ($count==1){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';

			} else if ($count==2){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';

			} else if ($count==3){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';
			
			} else if ($count==4){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';
			
			} else if ($count==5){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';

			}

			

			mysql_free_result($result);

			echo'</table>';

 			?></td>

  </tr>

</table>

<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000">

  <tr>

    <td align="center" valign="top"><strong><?php echo '<table width="720" border="0" align="center" cellpadding="0" cellspacing="1">';

			include("dbase.php");

include("settings.php");

		    $count=0;

			$nTime=time();

			if (!isset($_GET['category']))

			{

			$select="SELECT * FROM chatmodels WHERE status='offline'".$query_add;

			} else{

			$select="SELECT * FROM chatmodels WHERE category='$_GET[category]' AND status='offline'".$query_add;

			}



			$result = mysql_query($select);

			while($row = mysql_fetch_array($result)) 

				{			

				$tBirthD=$row['birthDate'];

				$nYears=date('Y',time()-$tBirthD)-1970;

					

				$tempMessage=$row['message'];

				$username=$row['user'];

				$tempCity=$row['city'];

				$tempPlace=$row['broadcastplace'];

				$tempL1=$row['language1'];

				$tempL2=$row['language2'];	

				$tempL3=$row['language3'];	

				$tempL4=$row['language4'];	
                
				$status=$row['status'];
						

				$languagestring=$tempL1;

				if (strtolower($tempL2)!="none"){

				$languagestring.= ", ".$tempL2;

				}

				if (strtolower($tempL3)!="none"){

				$languagestring.= ", ".$tempL3;

				}

				if (strtolower($tempL4)!="none"){

				$languagestring.= ", ".$tempL4;

				}

				$count++;

				if ($count==1) {echo' <tr>';}

				echo '<td width="115" height="222" align="center" valign="middle" background="images/modelbox_red_v2_2.png">';

  				echo '<table width="115" height="211" border="0" cellpadding="0" cellspacing="0">';
				
	 			echo '<tr>';

                echo '<td height=70 align="center" valign="middle"><a href="ladydetails.php?user='.$username .'"><img src="models/'.$username.'/thumbnail.jpg" width="99" height="86" border="0"></a></td>';
		 		

				echo '</tr><tr>';
				
				echo '<tr>';

		 		echo '<td height=23 align="center" valign="top"><span class="modelbox_title"><a href="ladydetails.php?user='.$username .'">'.$username .'</a></span></td>';	

				echo '</tr><tr>';
				
				echo '<tr>';

		 		echo '<td height=18 align="center" valign="top"><span class="modelbox_title"><a href="ladydetails.php?user='.$username .'">BIO</a></span></td>';	

				echo '</tr><tr>';
				
				echo '<tr>';

		 		echo '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="gallery.php?user='.$username .'">PICTURE GALLERY</a></span></td>';	

				echo '</tr><tr>';

	 			echo '<tr>';

		 		echo '<td height=20 align="center" valign="top"><span class="modelbox_title"><a href="videos.php?model='.$username .'">VIDEO GALLERY</a></span></td>';	

				echo '</tr><tr>';

		      	    echo '<td height=20 align="left" valign="top">';

		        	echo '<span class="model_title_small">';

				    echo '<span class="model_message">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;'.$status.'</span><br>';

		        	//echo '<span class="model_message">&nbsp&nbsp&nbsp&nbsp&nbsp'.$tempMessage.'</span></td>';

				echo '</tr></table>';

				echo '  </td>';

				if ($count==6){ echo"</tr>"; $count=0;}

				}

			



			if ($count==1){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';

			} else if ($count==2){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';

			} else if ($count==3){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';
			
			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';
			
			} else if ($count==4){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			echo'</tr>';
			
			} else if ($count==5){

			echo'<td width="115"  height="222" align="center" valign="middle">&nbsp</td>';

			

			}

			

			mysql_free_result($result);

			echo'</table>';

 			?></strong></td>
  </tr>
</table>
<br />
<table width="720" height="34" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000">
  <tr>
    <td height="24" align="center" background="images/page_red_bar.png" class="form_definitions"><div align="right"><span class="style2">
      Page: <?
			if ($page > 1)
			{
		?>
      <span class="style3">&nbsp; <a href="index_ie.php?page=<?=($page-1)?>" target="_self">Previous</a> </span>
      <?php
			}
		?>
      <?
			for ($i=$start_from; $i<=$loop_till ;$i++)
			{
		?>
      <span class="style3">&nbsp; <a href="index_ie.php?page=<?=$i?>" target="_self">
        <? if ($i==$page) {echo "<font color='white'><b>";} echo $i; if ($i==$page) {echo "</b></font>";} ?>
        </a> </span>
      <?
			}
			if ($page < $loop_till)
			{
		?>
      <span class="style3">&nbsp; <a href="index_ie.php?page=<?=$page+1?>" target="_self">Next</a> </span>
      <?php
			}
		?>
    </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<center>
</center>
<?
include("_main.footer.php");
?>