<?php
include("_header-admin.php");
?>
<table width="80%" border="0" cellpadding="2" align="center" bgcolor="#EBEBEB">
<tr>
<td>
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
<th>
<h1>Site Logos</h1>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
			Website Main Logo: (299px by 56px)<br></br>
			<img src="../images/logo.png?<?=rand(1,32000)?>" width="100px">		
			<br>
			<form enctype="multipart/form-data" method="post" action="image_upload_script2.php">
Choose an image:<br></br>
<input name="uploaded_file" type="file"  style="font-size:18px;width:350px;"/><br>
<input type="submit" value="Upload Image" style="width:390px;margin-top:5px;background-color:#88039b;cursor:pointer;border-radius:30px;color:#fcf8ff;padding:8px;"/>
</form><br>
</th>
<th>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
			Registration image that displays in the chat<br></br>
			<img src="../images/chat-logo.png?<?=rand(1,32000)?>" width="100px" style="">		
			<br>
			<form enctype="multipart/form-data" method="post" action="image_upload_script.php">
Choose an image:<br></br>
<input name="uploaded_file" type="file"  style="font-size:18px;width:350px;"/><br>
<input type="submit" value="Upload Image" style="width:390px;margin-top:5px;background-color:#88039b;cursor:pointer;border-radius:30px;color:#fcf8ff;padding:8px;"/>
</form><br>
</th>
</td>
</tr>
</table>
<br>
<br>
<?php
include("_footer-admin.php")
?>