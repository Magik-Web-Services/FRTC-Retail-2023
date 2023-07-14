<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

if (isset($_COOKIE["usertype"])){

	
    include("_main.header.logged.in.php");	
	
			  	  

	} else {
 
		 
	include("_main.header.php");
	include("settings.php");		  
			  

	} ?>
<style>



.toys-main-container a {
    float: left;
    margin: 3px;
}
.toys-main-container {
    margin: 0 auto;
    display: table;
    width: 70%;
}
.toys-main-sub-container {
    width: auto;
    margin: 0 auto;
	    display: table;
}
.image-setion:last-child {
    width: 250px;
    float: right;
    margin-right: 10px;
    text-align: center;
}
.image-setion {
    width: 250px;
    float: left;
	margin-right: 10px;
	text-align: center;

	}
	

.image-setion a img {
    width: 80%;
    margin: 0 auto;
    text-align: center;
	padding-top: 18px;
}

.btns {
    opacity: 1;
}	
	
	
.btns:hover {
	opacity: 0.9;

	
}


body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
<div align="center">
  <p>&nbsp;</p>
  <p><img src="/images/lovense-logo.png" width="179" height="18" /><br />
  Remote Control Adult Toys </p>
  <p><br/>
    <br/>	
    
  </p>
</div>
<div class="toys-main-container">	
<div class="toys-main-sub-container">	


    <!-- All the following ID's can be found in your personal Lovense account.
	
    <!--Toy number 1 -->

	<div class="image-setion">
    <img border='0' width='auto' height='auto' alt='' src='/images/storeimage1.png' />
    <a href='https://www.lovense.com/r/<?php echo $lovenseSellerID1 ?>' target='_blank'>
	<div class="btns"><img src="<?php echo $siteurl ?>/images/buyToysBtn.png" class="btnn-image-product"/></div>
    </a>
    </div>
	
	<!-- Toy number 2 -->
	
	<div class="image-setion">
    <img border='0' width='auto' height='auto' alt='' src='/images/storeimage2.png' />
  <a href='https://www.lovense.com/r/<?php echo $lovenseSellerID2 ?>' target='_blank'>
	<div class="btns"><img src="<?php echo $siteurl ?>/images/buyToysBtn.png" class="btnn-image-product"/></div>
    </a>
    </div>
	
	<!-- Toy number 3 or UASB dongle. -->
    <div class="image-setion">
    <img border='0' width='auto' height='auto' alt='' src='/images/storeimage3.png' />
    <a href='https://www.lovense.com/r/<?php echo $lovenseSellerID3 ?>' target='_blank'>
	<div class="btns"><img src="<?php echo $siteurl ?>/images/buyToysBtn.png" class="btnn-image-product"/></div>
    </a>
    </div>
  </div>
</div>
<p><br/>
  <br/>
</p>

<p>&nbsp;</p>
<p align="center">All imagery, toys, patents, patents pending and copyrights are the property of Lovense.com and are subject to the Lovense <a href="https://www.lovense.com/terms-and-conditions" target="_blank">Terms of Service</a>.</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
  <?php
 include("_main.footer.php");
 ?>       

