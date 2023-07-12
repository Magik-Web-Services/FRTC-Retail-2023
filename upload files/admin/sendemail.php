<?
include("_header-admin.php")
?>





<form name="form1" method="post" action="dosendemail.php">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <div align="center">
    <table width="1010" height="80" border="0">
      <tr>
        <td class="a_small_title"><div align="center"><h1>Send Email To: <?php echo $_POST['email']?> (<?php echo $_POST['username']?>)</div></h1></td>
        </tr>
      </table>
  </div>
  <table width="1010" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td bgcolor="#F8F8F8">
	<table width="100%"  border="0" cellpadding="5">
      
    </table>
	<div align="center">
	  <p>&nbsp;</p>
	  <table width="72%" height="150"  border="0" class="small_title">
	    <tr>
	      <td class="a_small_title">Subject:          
	        <input name="subject" type="text" id="subject" size="104" maxlength="42"></td>
          </tr>
	    <tr>
	      <td class="a_small_title">Message:</td>
          </tr>
	    <tr>
	      <td class="big_title"><div align="center">
	        <textarea name="message" cols="104" rows="20" id="message"></textarea>
	        <br>
	          <input type="submit" name="Submit" value="Send Email" style="width:300px;background-color:#ddd;margin-top:15px;cursor:pointer;">
	          <input name="email" type="hidden" id="date4" value="<?php echo $_POST['email']; ?>">
	          <input name="id" type="hidden" id="id45" value="<?php echo $_POST['id']; ?>">
	          <input name="type" type="hidden" id="type" value="<?php echo $_POST['type']; ?>">
	          <input name="username" type="hidden" id="username4" value="<?php echo $_POST['username']; ?>">
	        </div></td>
          </tr>
	    </table>
	  </div>
	<div align="center"></div>
	<p>&nbsp;    </p>	</td>
  </tr>
</table>
</form>
<?
include("_footer-admin.php")
?>
