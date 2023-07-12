


<?php
include("../../dbase.php");
$result2300=mysql_query("SELECT * from chatmodels WHERE id='$_COOKIE[id]'");
$row4400 = mysql_fetch_array($result2300);
if($row4400['forced_logout']=='yes'){
	header("Location: $siteurl/logout.php");
}
error_reporting(0); // Turn off all error reporting

if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatmodels" )

{

header("location: ../../login.php");

} else{

include("../../dbase.php");

include("../../settings.php");

$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='".$_COOKIE['id']."' LIMIT 1");



	while($row = mysql_fetch_array($result)) 

	{	
	
	$username=$row['user'];	
	$gender=$row['gender'];	
    
	
	}

}

mysql_free_result($result);

?>
<style>


body {

background-color: #<? echo $broadcasterBackgroundColor; ?> !important;

}



.fa{
   font-size: 18px !important;

}



/*   Hide Lovense Button in broadcast page    */

.lvs-api[ku564o17] {
  display: none !important;
}




.chatWindow .chatRoom .message #sendMessage {
    padding: 5px 2px !important;
}

.vdchat-overlay{
	background-color:#<? echo $broadcasterBackgroundColor; ?> !important;
}
.vdchat-overlay .videoContainer {
    background-color: #fff !important;
    border: 0.5px solid #ccc !important;
}
.videoOptions { 
background-color: #fff !important;
}
.vdchat-overlay .chatWindow {
    background-color: #fff !important;
}
.chatWindow .chatRoom .message {
    background-color: #fff !important;
    border: 0.5px solid #ccc !important;
}
.videoOptions a {
    background-color: #000 !important;
	opacity: 0.9;
}
.chatWindow .chatRoom .message a {
    background-color: #6eb900 !important;
    border-radius: 4px;
}
.chatWindow .chatRoom .message #toggleUsers {
    border-radius: 4px;
    border-width: 0.5 !important;
    border-color: #a2a2a2 !important;
    border: solid;
    background-color: #3a94f4 !important;
	margin-top: -1px;
	
}
.chatWindow .chatRoom .message input {
    color: #000 !important;
}
a.myyourClass {
    display: none !important;
}
.request a.exit_clss, .request a.cancel_clss {
    display: block;
    background-color: #333333 !important;
    text-transform: uppercase;
}
.request {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
}
.request a{
    background-color: #333333 !important;
    text-transform: uppercase;
}

table#tableshow tbody tr td {
    text-align: center;
}


.videoOptions a {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    color: #fff;
    float: right;
    padding: 3px;
    margin: 0 5px !important;
    background-color: #222;
    border-radius: 2px;
    margin-bottom: 8px !important;
    height: 16px;
    line-height: 22px !important;
    padding: 6px 8px !important;
    vertical-align: middle !important;
	opacity: 0.9;
}
a.endPrivateChat {
    height: 18px;
    text-decoration: none;
}
table#subtableshow {
    position: relative;
    height: 200px;
    overflow-y: scroll;
    display: inline-block;
}
.tip-sections {
    padding: 5px 12px;
    color: #fff !important;
    position: absolute;
    bottom: 6%;
    z-index: 9999999999999999;
    left: 10%;
}


.profilePic{
    position: absolute !important;
	
	border: solid;
	border-width: 3px;
	border-color: #FFF;
	border-radius: 100% !important;
	
    top: 95px !important;
    left: 3.7% !important;
    z-index: 102 !important;

    
}








@media screen and (max-width: 480px) and (min-width: 320px){
.chatWindow .chatRoom {
    top: 0% !important;
}
}
@media screen and (max-width: 767px){
.mnnchatRoom {
    height: 170px;
    overflow: scroll;
}
.tip-sections ul li {
    color: #ccc;
    line-height: 16px;
    font-family: sans-serif;
    font-size: 12px;
}


.liveLogo{

  /*  top: 35px !important; */
   margin-top: -20px !important;
   margin-left: 0% !important;

}



.broadcastingAs{
    position: absolute;
  /*  border: solid;
    border-width: 0.5px;
    border-color: #0000006e;
    border-radius: 4px; */
    color: #FFF;
    padding: 5px;
    font-size: 16px;
    font-family: Arial, Helvetica, sans-serif;
    top: 85px !important;
    margin-left: 10%;
    z-index: 101 !important;
    opacity: 0.9;

    text-shadow: 1px 1px #6c6c6ccf;

}



.profilePic{
    position: absolute !important;
    top: 80px !important;
    left: 5% !important;
    z-index: 102 !important;

    
}






}








@media screen and (max-width: 767px) and (orientation: landscape)
{
	.mnnchatRoom {
		height: auto;
		overflow: inherit;
	}
	.chatWindow .chatRoom #messages {
    height: 220px !important;
}
table#subtableshow {
    position: relative;
    height: 200px;
    overflow-y: scroll;
    display: inline-block;
	    width: 235px;
}
.refreshh1244 {
    margin-top: 20px !important;
}
.tip-sections ul li {
    color: #ccc;
    line-height: 16px;
    font-family: sans-serif;
    font-size: 12px;
}


/* landscape */

.liveLogo{

  /*  top: 35px !important; 
   top: 20px !important;
   margin-left: 10% !important; */
   display:none !important;

}



.chatLogo{
   position: absolute;
   float:right !important;
   margin-bottom: 35px !important; 
  /* margin-left: 10% !important; */
   z-index: 9991 !important;
   

}




.broadcastingAs{
    position: absolute;
  /*  border: solid;
    border-width: 0.5px;
    border-color: #0000006e;
    border-radius: 4px; */
    color: #FFF;
    padding: 5px;
    font-size: 16px;
    font-family: Arial, Helvetica, sans-serif;
    top: 65px !important;
    margin-left: 9% !important;
    z-index: 101 !important;
    opacity: 0.9;

    text-shadow: 1px 1px #6c6c6ccf;

}



.profilePic{
    position: absolute !important;
    top: 60px !important;
    left: 5% !important;
    z-index: 102 !important;

    
}

}










@media screen and (max-width: 767px) and (orientation: landscape)
{
.tip-sections ul li {
    color: #fff;
    line-height: 16px;
    font-family: sans-serif;
    font-size: 12px;
}

}
</style>
<?php //echo "SELECT * from chatmodels WHERE id='".$_COOKIE['id']."'";
$result12=mysql_query("SELECT * from chatmodels WHERE id='".$_COOKIE['id']."' LIMIT 1");
$row12 = mysql_fetch_array($result12);
 $gender12=$row12['gender'];	
	
if(($gender12=="Female") or ($gender12=="TMTOF")){ ?>
	
<style>
.request a{
    background-color: #333333 !important;
    text-transform: uppercase;
}
.tip-sections {
    background-color: #333333 !important;
    padding: 5px 12px;
    color: #fff !important;
    position: absolute;
    bottom: 6%;
    z-index: 9999999999999999;
    left: 4%;
	opacity: 0.8;
}
</style>
<?php } else if(($gender12=="Male") or ($gender12=="TFTOM")){ ?>

<style>
.tip-sections {
    background-color: #333333 !important;
    padding: 5px 12px;
    color: #fff !important;
    position: absolute;
    bottom: 6%;
    z-index: 9999999999999999;
    left: 4%;
	opacity: 0.8;
}
.request a{
    background-color: #333333 !important;
    text-transform: uppercase;
}
</style>
<?php } ?>
<!DOCTYPE html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>


<script type="text/javascript" src="<? $siteurl ?>/cp/chatmodels/RTCMultiConnection.min.js"></script>   



<script type="text/javascript" src="<? $siteurl ?>/cp/chatmodels/socket.io.js"></script>   






<!--
<script type="text/javascript" src="https://stunlink.com:9001/dist/RTCMultiConnection.min.js"></script>

<script type="text/javascript" src="https://stunlink.com:9001/socket.io/socket.io.js"></script>
-->


<!--
<script src="<? $siteurl ?>/cp/chatmodels/easyrtcX.js"></script>
-->

$_COOKIE

<link href="../../rtc/broadcaster.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style>

.chatWindow .chatRoom #messages li b{
	font-style: italic;
}

.chatWindow .chatRoom #messages li.me b{
	color:red !important;
}

.chatWindow .chatRoom #messages li b#green{
	color:green;
}
.chatWindow .chatRoom #messages li b#purple{
	color:purple;
}
.chatWindow .chatRoom #messages li b#magenta{
	color:magenta;
}
.chatWindow .chatRoom #messages li b#blue{
	color:blue;
}
.chatWindow .chatRoom #messages li b#grey{
	color:grey;
}
.chatWindow .chatRoom #messages li img {
    vertical-align: middle;
}
.tip-sections ul {
    padding: 0;
    list-style: none;
    margin: 0;
}
 
.tip-sections ul li {
    color: #fff;
    line-height: 15px;
    font-family: sans-serif;
    font-size: 11px;
}






@media screen and (max-width: 767px){
table#subtableshow {
    position: relative;
    height: 135px;
    overflow-y: scroll;
    display: inline-block;
}
.refreshh1244 {
    margin-top: 50px;
}

}



.liveLogo{
    position: absolute;
    border: solid;
    border-width: 0.5px;
    border-color: #ff0000e8;
    border-radius: 4px;
    background-color: #ff0000e8;
    color: #FFF;
    padding: 2px;
    font-size: 14px;
    font-family: Arial, Helvetica, sans-serif;
    top: 54px;
    left: 4%;
    z-index: 100 !important;
    opacity: 0.9;
    font-weight: 600;


}



.liveLogo {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;

}




.broadcastingAs{
    position: absolute;
  /*  border: solid;
    border-width: 0.5px;
    border-color: #0000006e;
    border-radius: 4px; */
    color: #FFF;
    padding: 5px;
    font-size: 16px;
    font-family: Arial, Helvetica, sans-serif;
    top: 50px;
    left: 7%;
    z-index: 101 !important;
    opacity: 0.9;
  /*  font-weight: 600;
    background-color: #04040436; */
	text-shadow: 1px 1px #6c6c6ccf;


}




.chatLogo{
   position: absolute;
  /* float:right !important;
   margin-bottom: 35px !important; 
  /* margin-left: 10% !important; */
   z-index: 99991 !important;
   

}













/* iPhone 6 Plus landscape */
@media only screen
  and (min-device-width: 414px)
  and (max-device-width: 736px)
  and (orientation: landscape)
  and (-webkit-min-device-pixel-ratio: 3)
{ 







}







</style>

</head>
<body>

<script>
jQuery(document).ready(function(){
	
	
jQuery(".inputarea").keyup(function(e){

 if(e.which == 13) {
	 
      // jQuery("#messageText").val(jQuery(this).html());
	   
	   jQuery(this).html('');
	   
       jQuery("#sendMessage").click();
	      
    }else{

jQuery("#messageText").val(jQuery(this).html());
	}

});	
	
jQuery(".showall").click(function(){
	
jQuery("#tableshow").toggle();	
	
});	
	
jQuery("#tableshow td").click(function(){
	
	//alert(jQuery("#inputarea").html());
	
	
	var textdata = jQuery(".inputarea").html()+jQuery(this).html();
	
//alert(textdata);
	
	jQuery(".inputarea").html(textdata);
	
	jQuery(".inputarea").keyup();
	
});
jQuery(".exit").click(function(){
 // alert("The paragraph was clicked.");
	jQuery(function() {
		setTimeout(function() { 
		
		$( ".request a" ).addClass( "myyourClass" );
	 
		// jQuery(".request").append( $( ".exit_clss" ) ); 
	
		// jQuery(".request").append( $( ".cancel_clss" ) ); 
		
		}, 1000)
	})
});
});
</script>
<script>
var IDLE_TIMEOUT = 6000000; //10 minute
var _idleSecondsTimer = null;
var _idleSecondsCounter = 0;

document.onclick = function() {
    _idleSecondsCounter = 0;
};

document.onmousemove = function() {
    _idleSecondsCounter = 0;
};

document.onkeypress = function() {
    _idleSecondsCounter = 0;
};

_idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
     _idleSecondsCounter++;
     var oPanel = document.getElementById("SecondsUntilExpire");
     if (oPanel)
         oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        window.clearInterval(_idleSecondsTimer);
		var post_data = {
			'modelname': "datas"
		};
		$.ajax({
			type: "POST",
			url: "<? $siteurl ?>/token_message.php",
			data: post_data,
			success: function (data) {
			}
		});
        alert("Time expired!");
		
        document.location.href = "<? $siteurl ?>/logout.php";
    }
}
</script>
<script>
$(document).ready(function(){
setInterval(function(){
$(".refreshh1244").load("broadcast.php .tip-sectionsa")
}, 1000);
});
</script>
<input type="hidden" name="modelid" value="<?php echo $_COOKIE['id']; ?>">

<script type="text/javascript">

</script>
<a href="/cp/chatmodels/updateprofile.php?mdl_ext" class="exit_clss" onClick="VideoChat.CloseNotification();">EXIT</a><a href="#" onClick="VideoChat.CloseNotification();" class="cancel_clss" >Cancel</a>
<!--<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8D0101">
<?php
$sql="SELECT * FROM setting WHERE type = 'media_server' ";
$mediaUrl=mysql_fetch_array(mysql_query($sql))['value'];
?>
  <?
  

  include("../../dbase.php");

  $model=$username;

 	$tempMoneyEarned=0;

  	$tempMoneySent=0;

	$result = mysql_query("SELECT * FROM videosessions WHERE model='$model'");

	while($row = mysql_fetch_array($result)) 

		{

		$epercentage=$row['epercentage'];

		$duration=$row['duration'];

		$cpm=$row['cpm'];

		$ammount=(($duration/60)*$cpm)*$epercentage/10000 ;

		$tempMoneyEarned+=$ammount;

		if ($row['paid']=="1"){

			$tempMoneySent+=$ammount;

			}

		}

	mysql_free_result($result);

 

  $nMoney=$tempMoneyEarned-$tempMoneySent;

  /*$result = mysql_query('SELECT moneyEarned,moneySent FROM chatmodelsstatus WHERE id="'.$_COOKIE["id"].'" LIMIT 1');

  while($row = mysql_fetch_array($result)) 

  {

  $nMoney=$row[moneyEarned];

  $nMoneySent=$row[moneySent];

  $nMoney=$nMoney-$nMoneySent;

  }*/

  $result = mysql_query('SELECT id,user,cpm,epercentage,lovense FROM chatmodels WHERE id="'.$_COOKIE["id"].'" LIMIT 1');

			while($row = mysql_fetch_array($result)) 

			{

			$nCpm=$row['cpm'];

			$sUser=$row['user'];

			$sId=$row['id'];

			$epercentage=$row['epercentage'];
            $lovense=$row['lovense'];

			}

	mysql_free_result($result);

  ?>

  

  <tr valign="top">

    <td height="754" colspan="6"><div align="center">

      <p>&nbsp;        </p>
      <p>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="1100" height="600">
          <param name="movie" value="BroadcastInterface.swf" />
          <param name=FlashVars value="&tepercentage=<? echo $epercentage;?>&fuser=<? echo $sUser; ?>&fcpm=<? echo $nCpm; ?>&fid=<? echo $sId; ?>&fmoney=<? echo $nMoney; ?>&connection=<? echo $connection_string;?>" />
          <param name="quality" value="high" />
          <embed flashvars="&tepercentage=<? echo $epercentage;?>&fuser=<? echo $sUser; ?>&fcpm=<? echo $nCpm; ?>&fid=<? echo $sId; ?>&fmoney=<? echo $nMoney; ?>&connection=<? echo $connection_string;?>" src="BroadcastInterface.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="1100" height="600"></embed>
        </object>
      </p>
    </div></td>
  </tr>

  <tr>

    <td width="225">&nbsp;</td>

    <td width="170">&nbsp;</td>

    <td width="176">&nbsp;</td>

    <td width="381" colspan="2">&nbsp;</td>
  </tr>
</table>-->





<div class="vdchat-overlay m-b-xxl">
    <div class="container">
                    <div class="col-lg">
                        <div class="videoContainer wrapper-md m-t-xxl">


                  



                            <div class="videoOptions">
                                
                                <a href="#" class="endPrivateChat hidden" onClick="return VideoChat.EndPrivateChat();">End Private Chat</a>								
                                <a href="#" class="exit" onClick="return VideoChat.ExitChatRoom();"><i class="fa fa-close"></i></a>
                                <a href="#" class="expand" onClick="return VideoChat.ToggleFullScreen();"><i class="fa fa-arrows-alt"></i></a>
                                <a href="#" class="mute" onClick="return VideoChat.ToggleMute();"><i class="fa fa-volume-off"></i></a>
                                <a href="#" class="mic" onClick="return VideoChat.ToggleMicro();"><i class="fa fa-microphone"></i></a>
                                <a href="#" class="cam" onClick="return VideoChat.ToggleCam();"><i class="fa fa-video-camera"></i></a>
                                </div>
								
							
							

							
							
							<div class="max-video-w">

					
							<div class="refreshh1244">
									<div class="tip-sectionsa">
									<?php
											$relt22 = mysql_query("SELECT SUM(cpm), MAX(cpm) FROM videosessions_copy WHERE model='$model' ORDER BY date DESC");
											//$result22 = mysql_query("SELECT * FROM videosessions");
											$row12122 = mysql_fetch_array($relt22);
											//echo "<pre>"; print_r($row12122); echo "</pre>";
											$total_tip = $row12122['SUM(cpm)'];
											$max_tip = $row12122['MAX(cpm)'];
											$tipgoal = $row12122['tipgoal'];
											$relt12202 = mysql_query("SELECT cpm as cptoken, member as latst_tokn_mmbr_nm FROM videosessions_copy WHERE model='$model' ORDER BY date DESC");
											$row1210022 = mysql_fetch_array($relt12202);
											//echo "<pre>"; print_r($row1210022['latst_tokn_mmbr_nm']); echo "</pre>";
											$latest_tip = $row1210022['cptoken'];
											$latest_tip_member = $row1210022['latst_tokn_mmbr_nm'];
											$relt220 = mysql_query("SELECT member FROM videosessions_copy WHERE cpm='$max_tip' ORDER BY date DESC LIMIT 1");			
											while($row121220= mysql_fetch_array($relt220)) 
											{
												$member_name = $row121220['member'];
											}
											$resulttipgoal = mysql_query("SELECT tipgoal FROM chatmodels WHERE user='".$model."' LIMIT 1");
											$rowtipgoal = mysql_fetch_array($resulttipgoal);
											$tipgoal=$rowtipgoal['tipgoal'];
											if(($tipgoal=="") || ($tipgoal=="0")){
											echo "<style>
											.tip-sections {
												background-color: #333333 !important;
												padding: 5px 12px;
												color: #fff !important;
												position: absolute;
												bottom: 6%;
												z-index: 9999999999999999;
												left: 10%;
												display: none;
											}
											</style>";
											}
										?>
										<div class="tip-sections">
										
										
											<ul>
												<li>
													<strong>Tip Received/Goal: </strong> 
													<span><?php if($total_tip==""){ echo "0"; }else{ echo $total_tip; } ?>/<?php if($tipgoal=="") { echo "0"; }else { echo $tipgoal; }?> </span>
												</li>
												<li>
													<strong>Highest Tip: </strong> 
													<span><?php if($max_tip==""){ echo "0"; }else{ echo $member_name; echo " (".$max_tip.")"; } ?></span>
												</li>
												<li>
													<strong>Latest Tip Received: </strong> 
													<span><?php if($latest_tip==""){ echo "0"; }else{ echo $latest_tip_member; echo " (".$latest_tip.")"; } ?></span>
												</li>					
											</ul>
										</div>
									</div>
								</div>
										<img class="respotralogo" src="logoresponsive.png"	style="">
                            <video autoplay id="streamerVideo" class="mainVideo">
                            </video>
                            <video autoplay id="selfVideo" muted volume="0"></video>
							</div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="col-sm m-t-xxl">
                        <div class="chatWindow">
                          <ul id="users" class="users">

                            </ul>
                            <div class="chatRoom">
                            <div class="mnnchatRoom">
                                <ul id="messages">
									<?php 
									$reslt = mysql_query("SELECT * FROM users_models_message  WHERE  broadcast_id='$username'");
									//$rslt = mysql_fetch_array($reslt);
									while($rslt = mysql_fetch_array($reslt)){
									//echo "<pre>"; print_r($rslt);
										if($rslt['sender_id']!=$username){
										
									$musername = $rslt['sender_id'];
										
									$resltt = mysql_query("SELECT money FROM chatusers  WHERE  user='$musername'");		
									$data =	mysql_fetch_array($resltt);
									
									
									if($data['money'] >= 200 ){
										
										$color = 'green';
										
									}elseif($data['money'] >= 100 && $data['money'] <= 199 ){
										
										$color = 'purple';
										
									}elseif($data['money'] >= 50 && $data['money'] <= 99 ){
										
										$color = 'magenta';
										
									}elseif($data['money'] >= 1 && $data['money'] <= 49 ){
										
										$color = 'blue';
									}else{								
										$color = 'grey';	
									}
											
											echo "<li ><b style='color:".$color.";'>".$rslt['sender_id']." : </b> ".$rslt['message']."</li>";	
										}else{
											echo "<li ><b style='color:red;'>Me : </b> ".$rslt['message']."</li>";	
										}								
									}
									?>
                                </ul>
								</div>
                                <div class="message">
						<div class="maindiv">		
							<div class="inputarea" contentEditable="true">

						</div>	
								
								
                             <input style="display:none;" id="messageText" placeholder="Enter your message here" onKeyUp="return VideoChat.SendMessageOnEnter(event);"/> 
								 
						<!---		 <textarea id="messageText" placeholder="Enter your message here" onKeyUp="return VideoChat.SendMessageOnEnter(event);"></textarea> -->
								 
					<span class="showall"><img src="<? $siteurl ?>/cp/chatmodels/images/annoyed.png"  /> </span>
						</div>		 
                                    <a id="toggleUsers" class="toggleUsers" href="#" onClick="VideoChat.ToggleUsers(); return false;"><i class="fa fa-users"></i></a>
                                    <a id="sendMessage" class="sendMessage" href="#" onClick="VideoChat.SendMessage(); return false;">Send</a>
		

						<div id="tableshow"  style="display:none">
                        <table id="subtableshow">
						
                              <tr class="new_icon">
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/star-eyes.png"  /></td>

                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/3hearts.png"  /></td>

                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/silly1.png" /></td>

                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/cool.png" /></td>
                                
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/eye-glass.png" /></td>
                               
                            </tr>
							
                            <tr class="new_icon">
							
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/dazed.png"  /></td>
                                                       
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/drooling.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/heart-eyes.png"  /></td>
                              
                               
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/regular-smile.png"  /></td>
                               
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/sad.png"  /></td>
	 
                            </tr>
							
							
							
                            <tr class="new_icon">
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/unhappy2.png"  /></td>
                               
							   <td><img src="<? $siteurl ?>/cp/chatmodels/images/pissed.png"  /></td>
                                
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/turd.png"  /></td>
                                
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/party.png"  /></td>
                                
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/party2.png"  /></td>
                            </tr>
                            
							
							
							
							
							<tr class="new_icon">
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/hot-head.png"  /></td>
                              
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/blow-kiss.png"  /></td>
                              
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/blush.png"  /></td>
                             
                          
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/confused.png"   /></td>
                               
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/nerd.png"  /></td>
                              
							</tr>
							<tr class="new_icon">
							
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/red-heart.png"  /></td>
								
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/purple-heart.png"  /></td>                            
                        
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/green-heart.png"  /></td>
                               
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/orange-heart.png"  /></td>
                               
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/blue-heart.png" /></td>
                               
                            </tr>
                            <tr class="new_icon">
							
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/yellow-heart.png"  /></td>
                               
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/gift-heart.png" /></td>
                              
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/fire.png"  /></td>
                               
                           
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/fingers-crossed.png"  /></td>
                               
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/high-five.png"  /></td>
                               
                            </tr>
							
							
                            <tr class="new_icon">   
							
							   <td><img src="<? $siteurl ?>/cp/chatmodels/images/thumbs-up.png" /></td>
                              
                           
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/pray.png"  /></td>
                               
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/up.png"  /></td>
                              
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/nails.png" /></td>
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/video-camera.png" /></td>
                           
                            </tr>
							
							<tr class="new_icon">
							
                                <td><img src="<? $siteurl ?>/cp/chatmodels/images/egg.png" /></td>
                                
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/pizza.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/birthday-cake.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/hat.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/girl-dancing.png" /></td>
								
                            </tr>
							<tr class="new_icon">
							
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/i-dont-know.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/man-dancing.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/this.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/baby.png" /></td>
								
								<td><img src="<? $siteurl ?>/cp/chatmodels/images/oh-no.png" /></td>
																
                            </tr>
                            <tr>
							

                        </table>
						</div>


								
									
                                </div>
                            </div>
                        </div>
                    </div>

    </div>
</div>


<script type="text/javascript" src="<? $siteurl ?>/cp/chatmodels/socket.io.js"></script>
    <script type="text/javascript">
  /**
   * This is sloppy way of doing this but fuck it...
   * the entire script is sloppy so who cares...
   */
$(document).ready(function(){
	
    function tipping(name,amt)
        {
            alert(amt);
            lovense.receiveTip(name,amt);
        }
	
	
	
	
	
  //lets do some chat styling...
  //Hide Un-used buttons
  $("#toggleUsers").addClass("btn btn-primary");
  
  //Handle Send Message Button
  $("#sendMessage").addClass("btn btn-primary btn-sm");

});
</script>
    <script type="text/javascript">
    /* Database Logic */
var Users = [
    { Username: "<? echo $sUser; ?>", Password: "<? echo $sUser; ?>", IsStreamer: true, ImageUrl: "/models/<? echo $sUser; ?>/thumbnail.jpg", IsAdmin: false }
];
var udata = '<?=$sUser?>';
var mediaUrl = '<?=$mediaUrl?>';
var lovense_token= "<? echo $lovense; ?>";
    </script>
     <?php
    if($lovense!==null)
    {
        echo '<script src="https://api.lovense.com/api/cam/model/model.js?mToken='.$lovense.'"></script>';    
    }
    ?>
    <script src="/rtc/videochat_broadcaster.js"></script>
	
	<style>

	
	</style>
	
	<div class="liveLogo">LIVE</div>
	<div class="broadcastingAs">Broadcasting live as: <? echo $username; ?></div>
	<div class="profilePic"><img src="../../models/<? echo $username; ?>/thumbnail.jpg" width="45px" height="45px" style="border-radius:100px !important;"></div>
	

   
    </body></html>
