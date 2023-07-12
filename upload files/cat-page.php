<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title><?php echo $sitename; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
<!--
.layer2 {
font-size: xx-large;
margin-left: 3%;



}

-->
</style>
<head>
<?
include("dbase.php");
include("settings.php");
$nTime=time(); 

		  

		  //we set the status to offline to models that have not changed theyr status for 30 seconds

		  mysql_query("UPDATE chatmodels SET status='offline' WHERE $nTime-lastupdate>30 AND status!='rejected' AND status!='blocked' AND status!='pending' AND forcedOnline='0'");
?>



	
	<style type="text/css">
	

	body,td,th {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}

body {
	margin-left: 0px;
	
	margin-right: 0px;
	
	margin-top: 0px;
	
	margin-bottom: 0px;
    
	background-color: #8F0000;
	
	align: center;

}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
a:hover {
	color: #FFFFFF;
	text-decoration: none;
}
a:active {
	color: #ffffff;
	text-decoration: none;
}







	






#search input[type="text"] {
align: center;
margin-top: 0px;
  background:  #000;
    border: 0 none;
    font: bold 18px Arial,Helvetica,Sans-serif;
    color: #fff;
    width: 50% !important;
    padding: 6px 15px 6px 5px;


/* 




    -webkit-border-radius: 0px 4px 4px 0px ;
    -moz-border-radius: 0px 4px 4px 0px ;
    border-radius:0px 4px 4px 0px ;




 */




    text-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 3px rgba(0, 0, 0, 0.2) inset;
    -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 3px rgba(0, 0, 0, 0.2) inset;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 3px rgba(0, 0, 0, 0.2) inset;
    
	
	/*
	
	
	-webkit-transition: all 0.7s ease 0s;
    -moz-transition: all 0.7s ease 0s;
    -o-transition: all 0.7s ease 0s;
    transition: all 0.7s ease 0s;
	
	
	*/
	
	
	margin-left: 1%;
	margin-right: 1%;

    height:25px;

	
	
    } 




    </style>



<?php
$query=mysql_query("select * from category order by name asc");
while($row=mysql_fetch_object($query))
{
$cats[]=$row->name;
}
$cat_array=array_chunk($cats,1000);
$columns=count($cat_array);
?>








<style type="text/css">
<!--











.button1 {
	width:99%;
	height:30px;
	background-color: #7C9E07;
	color: 000;
	border-style:solid;
	border-width: 1px;
	border-color:#000000;
	margin-left: 0%;
	padding: 0px;
	margin-top: 0px;
	text-align:center;
	opacity: 0.9;	
	
}


.button1:hover {
opacity: 1;	
	
	
}



.button2 {
position:relative;
	width:99%;
	height:30px;
	background-color: #CC3300;
	color: 000;
	border-style:solid;
	border-width: 1px;
	border-color:#000000;
	margin-left: 0%;
	padding: 0px;
	margin-top: 0px;
	text-align:center;
	opacity: 0.9;

}



.button2:hover {
opacity: 1;	
	
	
}









.searchbutton {
margin-top: -5%;
margin-left: -50%;



}


#Layer1 {
	position:absolute;
	width:10px;
	height:23px;
	z-index:1;
	left: 1458px;
	top: 29px;
}
.style1 {
font-size: 24px;
background-color: transparent;
z-index: 5;
float:right;
margin-top: 0px;
margin-right: 5%;




}

.categorytext {
color: FFF;
font-size: 16px;
left: 5px;






}





-->
</style>
</head>


<body>
<table width="100%" cellpadding="5" class="">
  <tr>
    <td width="29%" valign="top"><span style="font-size: 28px; color: #FFF;">LivePlayhouse</font></span></td>


<td width="61%">&nbsp;</td>
  <td width="10%" class="mheader"><h1><button onclick="goBack()">X</button></h1>  </tr>
</table>




















<script>
function goBack() {
    window.history.back();
}
</script>

<form action="searchModel_ff.php" method="post" id="search">

  <div class="searchbutton"><input class="" type="submit"></div> 
  
  <input name="search" type="text" size="40" placeholder="Search..." /></form>
  
  
  
<br />








<a href="login_member.php">
<div class="button2">Member Login</div>
</a>  


<a href="broadcaster.php">
<div class="button2">Performer Login</div>
</a>



<a href="registration/user.php">
<div class="button2">Member Registration</div>
</a>



<a href="registration/model.php">
<div class="button2"><span class="" valign="middle">Performer Registration</div>
</a>


<br />

<br />
<div class="categorytext">Categories</div>



<?php
foreach($cat_array as $cat)
{
echo '<div class="column" style="width:'.(100/$columns).'%">';
foreach($cat as $c)
{
echo '<a href="category.php?category='.$c.'"><div class="button1">'.$c.'</div></a>';
}	
echo '</div>';
}
?>

</div>
</li>       




</td>
</tr>
</table>
</div>


