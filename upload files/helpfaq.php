<?php 
if (isset($_COOKIE["usertype"])){
	include("_main.header.logged.in.php");	
} else {
	include("_main.header.php");		  
}
?>

<? include("settings.php"); ?>

<style type="text/css">
.help-faq {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
	

<div class="help-faq">
	<ul>
		<li>
			<b>Q. How old must you be to view this site?</b>
			<span>A. You must be at least 18 years of age to view or become a member or broadcaster on our site.</span>
		</li>
		<li>
			<b>Q. Can I be both a member and broadcaster on <? echo $sitename  ?> website?</b>
			<span>A. Yes, the only restriction is one model and/or one member account per person.</span>
		</li>
		<li>
			<b>Q. Does <? echo $sitename ?> charge monthly membership fees? And if so how much?</b>
			<span>A. No, currently there are no monthly membership fees, members purchase tokens to use as needed.</span>
		</li>
		<li>
			<b>Q. Do you pay your broadcasters?</b>
			<span>A. Yes, broadcasters earn between <? echo $percentagePayout ?>% of their earnings on our site.</span>
		</li>
        <li>
			<b>Q. How often does <? echo $sitename  ?> pay broadcasters?</b>
			<span>A. Broadcasters are paid twice a month, on the 15th and the last day of the month.</span>
		</li>
        <li>
			<b>Q. How do broadcasters receive their payment?</b>
			<span>A. You have the option to select your payout method upon registration, if you require help, please contact us.</span>
		</li>

      <li>
			<b>Q. How can I make the most cash on <? echo $sitename  ?>?</b>
			<span>A. Although we strategically market our site, we encourage broadcasters to use social media, twitter, facebook, Instagram etc.  by creating or using your existing page to direct your followers here.</span>
		</li>
        <li>
			<b>Q. How can I register for a phone chat line?</b>
			<span>A. Our most popular and profitable broadcasters can receive a phone chat line, you must show that you are earning sufficient income on your webcam site before being considered for a phone chat line.</span>
		</li>
        <li>
			<b>Q. Do I have to use my phone chat line everyday or on a schedule?</b>
			<span>A. No you do not, but while using the service you must generate sufficient income during that time or your line will be cancelled.</span>
		</li>
        <li>
			<b>Q. Where do broadcasters/members write with any issue’s concerning their account?</b>
			<span>A. Broadcasters or members can write to <? echo $registrationemail ?> regarding account questions or help.</span>
		</li>
        <li>
			<b>Q. What do the colored member usernames mean?</b>
			<span>A. The colored usernames are based on the number of tokens a user has in their account,
200 or more tokens <krn style="background: green;color:white;">green</krn> 100 -199 tokens <krn style="background: purple;color:white;">purple</krn> 50-99 tokens <krn style="background: magenta;color:white;">magenta</krn> 1-49 tokens <krn style="background: blue;color:white;">blue</krn>, members username with no tokens <krn style="background: grey;color:white;">Grey</krn>.
</span>
		</li>
        <li>
			<b>Q. How do I connect my lovense toy?</b>
			<span>A. Log into your Broadcaster account, in the drop down you will see a Lovense tab,
click the tab and follow the instructions. (You will need a Lovense Bluetooth USB adapter for laptop or PC’s). If you don’t already have it, download the Lovense Remote App and sign in.  Also log into lovense.com on the broadcast page, login information for Lovense Remote (app on your PC) and on your broadcast page should be the same. Plug in your Lovense USB adapter and follow the instructions on the Lovense page. Turn on your toy to be discovered by bluetooth. Click setup wizard if setting up a toy for the first time.  

Be sure to set your levels or if levels are already set, save settings EVERY time on the lovense page before you broadcast or your toy will not be searchable/recognized. If your levels are already saved/set and the save button is not enabled, refresh the page. All 5 default levels must be set in order to enable and click the save button or you can delete up to 4 levels and have only one and click save. If you are connecting on mobile, download and connect your toy with Lovense Connect or Lovense remote and follow instructions. Turn on your toy, If you are signing in with mobile, your location/GPS must be turned on for toy to be searchable/discovered.  Once your toy is paired, click on Broadcast.  You should see a dash cam on the page where you can test tip your toy to be sure its working.  
</span>
		</li>
        <li>
			<b>Q. The Lovense dash Icon is covering the emoticons or member view list how do I move it?</b>
			<span>A. The dash icon can be moved by clicking and holding and dragging wherever you like.</span>
		</li>
	</ul>
</div>



<?php	include("_main.footer.php"); ?> 