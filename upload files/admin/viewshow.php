<?
include("_header-admin.php");
?>
<html>
<head>
</head>

<?
include('../settings.php');
include('../dbase.php');
	$sUser="";
$model = $_GET["model"];
?>
<?php
$sql="SELECT * FROM setting WHERE type = 'media_server' ";
$mediaurl=mysql_fetch_array(mysql_query($sql))['value'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><? echo $sitename; ?> - Live Show</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="styles.css" rel="stylesheet" type="text/css"></head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<!--
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td colspan="6"><div align="center">
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="1115" height="600">
		  <PARAM NAME=FlashVars VALUE="&fuser=<? echo $sUser; ?>&fmodel=<? echo $_GET[model]; ?>&fid=<? echo $sId; ?>&fmoney=<? echo $nMoney;?>&favorite=<? echo $nFav;?>&freetime=<? echo $freetime;?>&connection=<? echo $connection_string;?>&cpm=<? echo $cpm; ?>">
          <param name="quality" value="high"><param name="SRC" value="viewshow.swf">
          <embed flashvars="&fuser=<? echo $sUser; ?>&fmodel=<? echo $_GET[model]; ?>&fid=<? echo $sId; ?>&fmoney=<? echo $nMoney;?>&favorite=<? echo $nFav;?>&freetime=<? echo $freetime;?>&connection=<? echo $connection_string;?>&cpm=<? echo $cpm; ?>" src="viewshow.swf" width="1115" height="600" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
      </object>
    </div></td>
  </tr>
</table>-->
<div class="vdchat-overlay">
  <div class="container">
        <div class="col-lg">
                        <div class="videoContainer">
                            <div class="videoOptions">
                                <a href="#" class="requestPrivateChat" onclick="return VideoChat.RequestPrivateChat();"><i class="fa fa-star"></i>&nbsp;Request Private Chat</a>
                                <a href="#" class="endPrivateChat hidden" onclick="return VideoChat.EndPrivateChat();"><i class="fa fa-star-o"></i>&nbsp;End Private Chat</a>
                                <a href="#" class="tip" onclick="VideoChat.GiveTip();"><i class="fa fa-money"></i>&nbsp;Tip</a>
                                <a href="#" class="exit" onclick="return VideoChat.ExitChatRoom();"><i class="fa fa-close"></i></a>
                                <a href="#" class="expand" onclick="return VideoChat.ToggleFullScreen();"><i class="fa fa-arrows-alt"></i></a>
                                <a href="#" class="mute" onclick="return VideoChat.ToggleMute();"><i class="fa fa-volume-off"></i></a>
                                <a href="#" class="mic" onclick="return VideoChat.ToggleMicro();"><i class="fa fa-microphone"></i></a>
                                <a href="#" class="cam" onclick="return VideoChat.ToggleCam();"><i class="fa fa-camera"></i></a>
                            </div>
                            <video autoplay="autoplay" id="streamerVideo" class="mainVideo">
                            </video>
                            <video autoplay="autoplay" id="selfVideo" muted="muted" volume="0"></video>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="chatWindow">
                            <ul id="users" class="users">
                                <!--Users Go Here-->
                            </ul>
                            <div class="chatRoom">
                                <ul id="messages">
                                    <!--Messages Go Here-->
                                </ul>
                                <div class="message">
                                    <input id="messageText" placeholder="Enter your message here" onkeyup="return VideoChat.SendMessageOnEnter(event);"/>
                                    <a id="toggleUsers" href="#" onclick="VideoChat.ToggleUsers(); return false;"><i class="fa fa-users"></i></a>
                                    <a id="sendMessage" href="#" onclick="VideoChat.SendMessage(); return false;">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
      
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--<script src="/socket.io/socket.io.min.js"></script>-->
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    
<script src="https://demo.easyrtc.com/easyrtc/easyrtc.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="/rtc/videochat_user.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
    /* Database Logic */
var Users = [
    { Username: "<?=$model?>", Password: "<?=$model?>", IsStreamer: true, 
    ImageUrl: "/models/<?=$model?>/thumbnail.jpg", perMin: 0,
    scpm: 0, IsAdmin: false },
    { Username: "admin", Password: "admin", IsStreamer: false, ImageUrl: "", tokens: 0, IsAdmin: true },
];
var udata = 'admin';
var mediaUrl = '<?=$mediaurl;?>';
    </script>
    <script src="/rtc/videochat_user.js"></script>
</body>
</html>
<?
include("_footer-admin.php");
?>