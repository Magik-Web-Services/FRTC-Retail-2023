<?php
if(isset($_POST['accountUser']) && isset($_POST['accountPassword']))

{	
include("dbase.php");
include("settings.php");
$resultdata = mysql_query("SELECT a.* FROM user_logged_in as a where a.user='".$_POST['accountUser']."' AND a.logged_in='yes1'");
$rowdata = mysql_num_rows($resultdata); 
if($rowdata>0){
	$errorMsg = "This user already logged in.";
	
}else{
	mysql_query("INSERT INTO user_logged_in SET user='".$_POST['accountUser']."', logged_in='yes'");
	if ($_POST['accountType']=="member")
	{
	$database="chatusers";

	} else if ($_POST['accountType']=="model")

	{

	$database="chatmodels";
	
	$staus_update = ", status='online'";


	} else if ($_POST['accountType']=="studioop")

	{

	$database="chatoperators";

	}

	

	

	$userExists=false;

	$result = mysql_query("SELECT id,user,password,status FROM $database WHERE status!='pending' AND status!='' ");

	while($row = mysql_fetch_array($result)) 

	{

		$tempUser=$row["user"];

		$tempPass=$row["password"];

		$tempId=$row["id"];

		

		if ($_POST['accountUser']==$tempUser && md5($_POST['accountPassword'])==$tempPass)

		{

			if ($row["status"]=="blocked")

			{

			$userExists=true;

			$errorMsg="Account is blocked, please contact the administrator for more details";

			} else {

			$randomnumber = rand(1000,9999);

		
			
			$userExists=true;

			$currentTime=time();

			mysql_query("UPDATE $database SET lastLogIn='$currentTime', loginkey=$randomnumber $staus_update WHERE id = '$tempId' LIMIT 1");

			setcookie("usertype", $database, time()+360000);

			setcookie("id", $tempId, time()+360000);
			
			session_start();
			$_SESSION["loginkey"] = $randomnumber;
			$sql=mysql_query("UPDATE chatmodels set forced_logout='no' where id='$tempId'");
			header("Location: cp/$database/");

			}

		}

	

	}

	if (!$userExists){

	$errorMsg="Wrong Username or password";

	}

	

	
}
} else if (isset($_GET['from']) && $_GET['from']=="recoverpass"){

	$errorMsg="Your new password has been sent to your email address";

} else {

	$errorMsg="";

}
include("_main.header.php");
?>


 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
$( document ).ready(function() {
$( "#btn" ).click(function() {
$( "#loginform" ).submit();
});
$(document).keypress(function(e) {
    if(e.which == 13) {
     $( "#loginform" ).submit();
    }
});
});

</script>

   
<style>

body{
color:#fff !important;	
	
}




.login {
  border: 1px solid #ccc;
  border-radius: 4px;
  display: table;
  margin: 68px auto;
  max-width: 422px;
  padding: 34px;
  width: 100%;
  margin-bottom:10%;
  
  
}
.login .titulo {
  color: #666666;
  font-family: Arial;
  font-size: 14px;
  font-weight: bold;
  height: 14px;
  margin-bottom: 30px;
  padding-bottom: 13px;
  text-align: center;
}

.login form {
    width: 300px;
    height: auto;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
}

.login form input[type="text"], .login form input[type="password"] {
  background: transparent none repeat scroll 0 0;
  border: 1px solid #ccc;
  border-radius: 0;
  
  font-size: 14px;
  height: 40px;
  margin: 0 0 9px;
  outline: medium none;
  padding: 0 10px;
  width: 100%;
}
.login form input[type="text"] {
  border-radius: 4px;
}
.login form input[type=password] {
  border-radius: 4px
}
.login form .enviar {
  background: #05b0fa none repeat scroll 0 0;
  border: medium none;
  border-radius: 6px;
  color: #fff;
  display: block;
  font-family: Arial;
  font-size: 15px;
  font-weight: bold;
  height: 12px;
  padding: 13px 0 33px;
  text-align: center;
  text-decoration: none;
  text-shadow: 0 -1px #1d7464, 0 1px #7bb8b3;
  width: 295px;
}
.login .olvido {
    width: 100%;
    height: auto;
    overflow: hidden;
    padding-top: 25px;
    padding-bottom: 25px;
    font-size: 10px;
    text-align: center;
}
.login .olvido .col:first-child {
    width: 45%;
    height: auto;
    float: left;
}
.login .olvido .col {
    width: 52%;
    height: auto;
    float: left;
}
.login .olvido .col:last-child {
    text-align: right !important;
}
.login .olvido .col a {
    color: #000;
    text-decoration: none;
    font: 12px Arial;
}
::-webkit-input-placeholder { /* WebKit browsers */
    color:    #222;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:    #222;
    opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:    #222;
    opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    color:    #222;
}

.terms {
width:80%;
margin: auto;
padding:10px;
text-align: left;
font-size:16px;

)


</style>
<div class="terms">
<section>


<div style="font-size:24px;">Terms & Conditions</div>

<p>&nbsp;</p>

<p>Your Company, Inc. (“Your Company,” “we,” or “us”) operates Your Company.com and associated sites and mobile applications (collectively, “Your Company.com”). Please read these Terms of Use carefully. They govern your access to and use of Your Company.com, its content, and the services offered on or through it. These Terms of Use constitute a binding legal agreement between you and us.</p>
<p>YOUR ACCESS OR USE OF OUR WEBSITE MEANS THAT YOU HAVE READ AND YOU UNDERSTAND AND AGREE TO BE BOUND BY THESE TERMS OF USE. IF YOU ACCESS OR USE OUR WEBSITE ON BEHALF OF AN ENTITY, YOU REPRESENT THAT YOU HAVE THE AUTHORITY TO BIND THAT ENTITY, AND THESE TERMS OF USE ARE THE AGREEMENT OF SUCH ENTITY. IN THAT EVENT, “YOU,” “YOUR,” “VISITOR,” AND “USER” REFER TO THAT ENTITY. IF YOU DO NOT AGREE TO THESE TERMS, THEN YOU HAVE NO RIGHT TO ACCESS OR USE OUR WEBSITE AND ITS CONTENT AND SERVICES.</p>
<h5>Eligibility</h5>
<p>We invite users and visitors to Your Company.com.</p>
<h5>Users</h5>
<p>Users are those of our customers registered to use Your Company.com. Users may, subject to these Terms of Use, (1) use a pilot version of the product which will use our Discovery Engine to create a Full Profile and Knowledge Graph for them, (2) use the Smart Layer to receive recommendations on expert colleagues in the network and relevant content within the network, (3) view the aggregated corporate dashboard, and (4) use other services which we may provide to Your Company.com users. To be a user, you must be at least 18 years old and legally capable of entering into this contract by yourself. When creating your account, you will be asked to choose a user name and password and may be asked to use your LinkedIn account or other supported social network. You must provide true, accurate and complete information. You may not let others use your account, or sell or otherwise transfer your account. You are responsible for maintaining the confidentiality of your password and for all activities that occur under your account. If you discover that the security of your account has been compromised, you must notify us as soon as possible by contacting us through <a href="http://corp.Your Company.com/contact-us/">http://corp.Your Company.com/contact-us/</a></p>
<h5>Visitors</h5>
<p>Visitors may, subject to these Terms of Use, access and browse Your Company.com and use the other Your Company.com services provided to visitors.</p>
<p>You must be at least 13 years old to post comments on Your Company.com and to give us your email address or any other personally identifiable information about you. If you are under 13, please do not give us any information about yourself, including your name, address, or email address. If we discover that a child under 13 has provided us with personally identifiable information, we will delete such information from our files.</p>
<h5>Privacy</h5>
<p>Our Privacy Policy describes how we collect, use, and disclose information we receive from users and visitors. By visiting or using Your Company.com, you agree to the practices described in them. If you have provided us with your contact information, we can use it to communicate with you. You may unsubscribe from marketing and research communications by following the directions in them.</p>
<h5>Content</h5>
<p>Your Company.com contains both Your Company content and user content. The content on Your Company.com and any authorized clients are licensed, not sold. Such content is protected by copyright laws and, if applicable, by international treaties.</p>
<h5>Your Company Content</h5>
<p>Your Company content is the content posted by us on Your Company.com; it does not include content submitted by any other Your Company.com user. We reserve the right to update or remove any Your Company content published on Your Company.com. We are under no obligation to keep the Your Company content up to date. Subject to your compliance with these Terms of Use, we authorize you to:</p>
<ul>
<li>View the Your Company content on Your Company.com;</li>
<li>Create and modify your Your Company Full Profile’s listed skills and knowledge graph details. As the user, you have the sole right to edit and publish the skills and expertise on your profile.</li>
<li>Copy, transmit, distribute, upload, embed, or display Your Company content, provided that if you do so for non-personal purposes (for example, commercial or political) you must preserve and include all copyright, trademark, service mark, attribution, and other proprietary rights notices displayed on or with such Your Company content.</li>
</ul>
<p>You may never do any of the things allowed by this license if your actions, as determined by us: (1) is otherwise unlawful or in violation of any court or administrative order; (2) is harmful to anyone else; or (3) suggests we promote or endorse your, or any third party’s, causes, ideas, websites, products, or services.</p>
<p>The Your Company content and any authorized copies are the intellectual property of Your Company and its licensors. The Your Company content and all of its copies are licensed, not sold. The Your Company content is protected by applicable law, including United States and foreign copyright laws and international treaties.</p>
<h5>Software</h5>
<p>We may provide you with software to interact with our services, such as a browser plug-in like the Your Company Discovery Engine to help users discover skills based on their professional web activity. When you register with our services, you will have the opportunity to download our software. You may use our software solely in connection with your authorized use of our services and in compliance with all applicable laws and regulations. By installing our software, except as expressly authorized by these terms, you agree not to: (i) copy or modify the software; (ii) transfer, sublicense, or otherwise redistribute the software to any third party; (iii) transfer or make the software available to multiple users through any means, (iv) disassemble, decompile, or reverse engineer the software, in whole or in part, or permit or authorize a third party to do so; or (v) otherwise exploit the software.</p>
<h5>User Content</h5>
<p>User content includes text, graphics, and other material and information (such as your profile attributes, profile image, and expertise) that you upload or post to our services. All listed profile pictures and contact details are managed by the user. Users have the ability to edit and modify all of their listed skills before they are published to the network. Users cannot edit or modify the details listed on each other’s profiles. The complete list of searchable terms to be used by the Your Company Discovery Engine are chosen by the enterprise client’s administrator. All of the content stored within each user’s profile is not publicly available, nor is it searchable by third-party search engines such as Google. If a private network is created for an enterprise client, only employees of that customer on that network with a verified corporate email address can see other users’ content. By uploading or posting any user content, you give us the right and license to store, reproduce, modify, create derivative works of, publish, distribute, transfer, transmit, publicly display, publicly perform, and use your user content in connection with providing our services.</p>
<p>We expect our users and visitors to act responsibly, respectfully, and lawfully on Your Company.com. You agree not to post content on your Your Company.com profile that, or the act of posting of which: (1) is unlawful, obscene, pornographic, violent, defamatory, fraudulent, harassing, or harmful to others; (2) violates the rights, including intellectual property rights, or the privacy of any other person; (3) incites or furthers criminal or unlawful acts; (4) constitutes hate speech or a personal attack; (5) contains viruses or other features that can harm Your Company.com or other property; (6) impersonates or defames another person; or (7) which may otherwise expose us or our users or visitors to liability. We reserve the right to review any user content and determine, in our discretion, whether it violates these Terms of Use. However, we assume no obligation to do so and have no responsibility for user content on Your Company.com. To report user content, you may contact us through https://Your Company.zendesk.com/hc/en-us.</p>
<p>We reserve the right to refuse to post or to remove or delete any user content on Your Company.com, at our discretion and with or without notice. When you delete your skills from your Your Company Full Profile, we will remove them from your account view and other public areas on Your Company.com as soon as possible, and in any event within 48 hours unless there are unforeseen circumstances. Residual data may remain on our servers for up to 90 days. After such period, we may retain copies only if there is a pending legal issue with such content or if we are otherwise required by law, regulation, or legal process.</p>
<p>You represent and warrant that: (1) you own the content that you post on Your Company.com or otherwise have the right to post it on Your Company.com and grant the above licenses with respect to such content; (2) your posting of any content on Your Company.com does not violate any law, regulation, court or administrative order, or the rights of any third party; and (3) your posting of any content on Your Company.com does not breach any contract between you and a third party.</p>
<h5>Conduct</h5>
<p>You may only use Your Company.com in compliance with these Terms of Use and applicable laws and regulations. Conduct that is harmful to us or others or that disrupts Your Company.com or its use by others is prohibited. Below we include several examples of prohibited conduct on Your Company.com:</p>
<ul>
<li>Accessing, tampering with, or using other users’ accounts or any non-public areas of Your Company.com, Your Company’ computer systems, or the technical delivery systems of Your Company’ providers;</li>
<li>Unauthorized monitoring of data or traffic on Your Company.com, Your Company’ computer systems, or the technical delivery systems of Your Company’ providers;</li>
<li>Probing, scanning, or testing the vulnerability of any Your Company system or network, or breaching any security or authentication measures;</li>
<li>Circumventing any technological measure that protects Your Company.com;</li>
<li>Removing any Your Company digital or software identifying tags, whether embedded or otherwise or whether visible or hidden;</li>
<li>Attempting to access or search Your Company.com, or downloading content from Your Company.com through any means other than the software provided by Your Company or other generally available third party web browsers (for example, Microsoft Internet Explorer, Mozilla Firefox, or Safari) or public search engines (for example, Google);</li>
<li>Sending or posting any unsolicited or unauthorized advertising, promotional materials, email, junk mail, spam, chain letters, or other form of solicitation;</li>
<li>Using any meta tags or other hidden text or metadata utilizing a Your Company trademark, logo, URL, or product name without our prior consent;</li>
<li>Forging any TCP/IP packet header or any part of the header information in any email, or in any way using Your Company.com or Your Company’ systems to send altered, deceptive, or false source-identifying information;</li>
<li>Attempting to decipher, decompile, disassemble, or reverse engineer (except as permitted by law) any of the software used to provide Your Company.com and its content and services;</li>
<li>Interfering with the access of any user, host, or network, including, without limitation, sending a virus, or overloading, flooding, spamming, or mail-bombing Your Company.com;</li>
<li>Collecting, using or storing any personally identifiable information from Your Company.com users or visitors without their express informed consent;</li>
<li>Impersonating or misrepresenting your affiliation with others;</li>
<li>Encouraging or enabling others to do any of the foregoing.</li>
</ul>
<p>You acknowledge that we have the right to monitor your access to and use of Your Company.com to ensure your compliance with these Terms of Use, or to comply with applicable law or the order or requirement of a court, administrative agency, or other governmental body. However, we do not undertake to do so or to enforce violations by others of these Terms of Use with respect to your content or otherwise, and, to the maximum extent permitted by law, we will not have any liability to you for our failure to prevent, cease, or remedy such violations.</p>
<h5>Intellectual Property Policy</h5>
<p>We respect the intellectual property rights of others and expect you to do the same. If you believe that a third party infringes your copyright or other intellectual property rights on Your Company.com, please provide us with a notice containing the following:</p>
<ul>
<li>A physical or electronic signature of the owner of the infringed right or of another person authorized to act on the owner’s behalf;</li>
<li>Identification of the copyrighted work or other intellectual property that you believe has been infringed; if multiple copyrighted works are covered by a single notice, a representative list of such works;</li>
<li>A description of where the allegedly infringing material is located on Your Company.com;</li>
<li>Your address, telephone number, and email address;</li>
<li>A statement by you that you have a good faith belief that the disputed use is not authorized by the copyright or intellectul property owner, its agent, or the law;</li>
<li>A statement by you that the information in the notice is accurate, and, under penalty of perjury, that you are authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
</ul>
<p>You can reach our designated agent for receipt of such notices as follows:</p>
<h5>Copyright Agent</h5>
<p><b>Your Company, Inc.</b><br/>
123 Some St<br/>
Some City, CA 90210<br/>
1-234-567-8910</p>
<p>Email: <a href="mailto:team@Your Company.com">team@Your Company.com</a></p>
<p>We respond to notices of alleged copyright infringement and terminate accounts of repeat infringers according to the process set out in the U.S. Digital Millennium Copyright Act.</p>
<h5>Links</h5>
<p>Your Company.com may contain links to third-party websites or resources. We are not responsible or liable for the availability or accuracy of such websites or resources or for their content, privacy policies, or services. Links to such websites or resources do not imply any endorsement by us.</p>
<p>You may include links from your website to Your Company.com, so long as you (1) do not portray Your Company and our products and services in a false, misleading, or derogatory way and (2) do not suggest that we promote or endorse your, or any third party’s, causes, ideas, web sites, or services.</p>
<h5>Contributions</h5>
<p>Your Company.com, our social media pages, and our email addresses may allow you to post or submit feedback, ideas, comments, and suggestions for us (collectively, “contributions”). Your submission of contributions to us is voluntary; your contributions are subject to the following terms: (1) you warrant that your contributions do not violate any confidentiality obligations that you may have to third parties and that they do not contain proprietary rights of third parties; (2) your contributions become the property of Your Company, and by posting them on Your Company.com you assign to Your Company all your rights in and to them and waive any “moral rights” with respect to them; (3) Your Company is free to disclose and use (or refuse to disclose or use) any contributions at its sole discretion; and (4) you are not entitled to any compensation or reimbursement of any kind under any circumstances. If you do not agree to these terms, please do not submit any contributions to us.</p>
<h5>Modification</h5>
<p>We reserve the right, at our discretion, to modify Your Company.com and any services provided on it or to modify these Terms of Use, at any time and without prior notice. We will notify you of any material changes to these Terms of Use by posting the new Terms of Use and a redline of the changes on our website. By continuing to access or use Your Company.com after we have posted a modification, you are indicating that you agree to be bound by the modified Terms of Use. If the modified Terms of Use are not acceptable to you, your only recourse is to cease visiting and using Your Company.com.</p>
<h5>Termination</h5>
<p>We may suspend or terminate your account or access to Your Company.com, or terminate or discontinue all or any part of Your Company.com, the services offered on it, or these Terms of Use, at our discretion, at any time, and without prior notice. Without limiting the foregoing, we reserve the right to terminate any account that has been inactive for a significant period of time, as determined at our discretion. You may terminate your account or stop using or visiting Your Company.com at any time. We will not be liable to you or any third party for termination of Your Company.com or termination of your use of it. Suspension or termination will not affect those of your obligations under the Terms of Use, which, by their sense and context, are intended to survive such suspension or termination.</p>
<h5>Indemnification</h5>
<p>You agree to indemnify and hold Your Company, its affiliates, and their respective officers, directors, employees, agents, licensors and service providers harmless from any claim or demand, including reasonable attorneys’ fees, made by any third party due to or arising out of content you post on Your Company.com, your violation of these Terms of Use or any law or regulation, or your violation of any rights of another.</p>
<h5>Disclaimer</h5>
<p>THE CONSUMER LAWS OF SOME COUNTRIES PROHIBIT THE EXCLUSION AND/OR LIMITATION OF WARRANTIES AND LIABILITY. THIS SECTION IS NOT INTENDED TO LIMIT YOUR CONSUMER RIGHTS UNDER THESE LAWS AND, WHERE PROHIBITED, IT WILL NOT APPLY TO YOU. FOR A FULL UNDERSTANDING OF YOUR RIGHTS, YOU SHOULD CONSULT THE LAWS OF YOUR COUNTRY.</p>
<p>TO THE FULLEST EXTENT PERMITTED BY LAW, Your Company.COM, ITS CONTENT AND THE SERVICES OFFERED ON OR THROUGH IT ARE PROVIDED “AS IS” AND “AS AVAILABLE,” WITHOUT WARRANTY, CONDITION, GUARANTEES, REPRESENTATIONS OR UNDERTAKINGS OF ANY KIND, EITHER EXPRESS OR IMPLIED. TO THE FULLEST EXTENT PERMITTED BY LAW, WE EXPLICITLY DISCLAIM ANY TERMS, WARRANTIES, CONDITIONS, GUARANTEES, REPRESENTATIONS OR UNDERTAKINGS OF MERCHANTABILITY, ACCEPTABLE QUALITY, FITNESS FOR A PARTICULAR PURPOSE, UNINTERRUPTED, ERROR FREE OR CONTINUOUS ACCESS AND SERVICE, OR NON-INFRINGEMENT, AND ANY TERMS, WARRANTIES, GUARANTEES, REPRESENTATIONS OR UNDERTAKINGS ARISING OUT OF OR IN THE COURSE OF DEALING OR USAGE OF TRADE. ANY CONTENT ON OR OBTAINED THROUGH Your Company.COM IS ACCESSED AT YOUR OWN DISCRETION AND RISK. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED FROM US OR THROUGH OUR WEBSITE OR Your Company CONTENT, WILL CREATE ANY TERM, WARRANTY, CONDITION, GUARANTEE, REPRESENTATION OR UNDERTAKING. SOME JURISDICTIONS DO NOT ALLOW DISCLAIMERS OF IMPLIED WARRANTIES, SO TO THAT EXTENT, THIS DISCLAIMER OF IMPLIED WARRANTIES MAY NOT APPLY TO YOU.</p>
<h5>Limitations of Liability</h5>
<p>TO THE FULLEST EXTENT PEMITTED BY LAW, Your Company, ITS AFFILIATES, AND THEIR RESPECTIVE SHAREHOLDERS, OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, LICENSORS AND SERVICE PROVIDERS WILL NOT BE LIABLE FOR ANY (1) PERSONAL INJURY; (2) SPECIAL, INCIDENTAL, EXEMPLARY, PUNITIVE OR CONSEQUENTIAL DAMAGES (OR FOR ANY LOSS OF: USE, DATA, BUSINESS, OR PROFITS OR ANY OTHER PECUNIARY LOSS); OR (3) COST OF PROCURING SUBSTITUTE SERVICES, IN EACH CASE ARISING OUT OF OR RELATED TO YOUR USE OR INABILITY TO USE OR RELIANCE UPON Your Company.COM, THE Your Company SERVICES, CONTENT, MATERIALS OR INFORMATION DIRECTLY OR INDIRECTLY PURCHASED FROM OR PROVIDED BY Your Company, WHETHER SUCH LIABILITY ARISES UNDER ANY INDEMNITY, WARRANTY, GUARANTEE OR FROM ANY CLAIM BASED UPON CONTRACT, WARRANTY, TORT (INCLUDING NEGLIGENCE), STRICT LIABILITY OR OTHERWISE. THESE LIMITATIONS WILL APPLY EVEN IF Your Company HAS BEEN ADVISED OF, OR SHOULD HAVE KNOWN OF, THE POSSIBILITY OF SUCH DAMAGES. IN NO EVENT SHALL Your Company’S TOTAL LIABILITY TO YOU FOR ALL DAMAGES (OTHER THAN AS MAY BE REQUIRED BY APPLICABLE LAW IN CASES OF PERSONAL INJURY) EXCEED THE GREATER OF (1) THE AMOUNT YOU PAID TO Your Company FOR THE SERVICE GIVING RISE TO THE DAMAGES, OR (2) US$25. THE LIMITATIONS IN THIS PARAGRAPH ARE A PART OF THE BARGAIN BETWEEN THE PARTIES AND APPLY EVEN IF THE LIMITED REMEDIES PROVIDED HEREIN FAIL OF THEIR ESSENTIAL PURPOSE. SOME JURISDICTIONS DO NOT ALLOW THE LIMITATION OR EXCLUSION OF CERTAIN LIABILITIES, SO THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU.</p>
<h5>Export</h5>
<p>You agree to comply fully with all applicable import, export and encryption laws including, U.S. import and export laws and regulations to ensure that the Your Company technology available on or through Your Company.com is not exported or re-exported directly or indirectly in violation of, or used for any purposes prohibited by, such laws and regulations.</p>
<h5>Proprietary Rights Notices</h5>
<p>Your Company, the Your Company logo, the look and feel of Your Company.com, and all trademarks, service marks, logos, trade names, slogans, and any other proprietary designations of Your Company and its services used on Your Company.com are trademarks of Your Company. All other marks are the property of their respective owners.</p>
<h5>Controlling Law and Jurisdiction</h5>
<p>These Terms of Use and any related action will be governed by the laws of the State of California, United States, without regard to conflict of laws provisions. The exclusive jurisdiction and venue of any action with respect to the subject matter of these Terms of Use will be the state and federal courts located in Santa Clara County, California, United States, and we and you waive any objection to this jurisdiction and venue.</p>
<h5>Entire Agreement</h5>
<p>From time to time, we may implement additional terms and conditions applicable to specific areas or services of Your Company.com or to particular content or transactions. These Terms of Use, the other documents referenced in these Terms of Use and such additional terms and conditions constitute the entire agreement between us and you regarding Your Company.com and its content and services. They supersede and replace all prior agreements between you and us regarding the same subject matter.</p>
<h5>Assignment</h5>
<p>You may not assign or transfer these Terms of Use, by operation of law or otherwise, without our prior written consent. Any attempt to assign or transfer without our consent will be null and of no effect. We may freely assign this agreement.</p>
<h5>Notices</h5>
<p>You consent to the use of electronic means to complete these Terms of Use and electronic records to store information related to these Terms of Use or your use of Your Company.com. Except as otherwise stated in these Terms of Use, any notices pursuant to these Terms of Use will be in writing and given: (1) by us via email (in each case to the address that you provide) or by posting on Your Company.com, or (2) by you to enterprise@Your Company.com.</p>
<h5>General</h5>
<p>Our failure to enforce any right will not constitute a waiver of future enforcement of that right. The waiver of any such right will be effective only if in writing and signed by our duly authorized representative. Except as expressly stated in these Terms of Use, the exercise by either party of any of its remedies under these Terms of Use will be without prejudice to its other remedies under these Terms of Use or otherwise. If a court of competent jurisdiction finds any provision of these Terms of Use invalid or unenforceable, that provision will be enforced to the maximum extent permissible and the other provisions of these Terms of Use will remain in full force and effect. The parties have agreed that these Terms of Use and all documents relating thereto will be drawn up in English.</p>
<h5>Contacting Us</h5>
<p>If you have any questions about these Terms of Use, please contact us at <a href="mailto:team@whoknows.com">team@whoknows.com</a>.</p>
<h5>Company Information</h5>
<p>Your Company, Inc. is a corporation organized under the laws of the State of California, USA.</p>
<p>Our headquarters are at:<br/>
your company, Inc.<br/>
123 Some St<br/>
Some City, CA 90210<br/>
1-234-567-8910</p>




</section>
</div>
<?php
include("_main.footer.php");
?>