<?php
if (isset($_POST['accountUser']) && isset($_POST['accountPassword'])) {
  include("dbase.php");
  include("settings.php");
  $resultdata = mysqli_query($conn, "SELECT a.* FROM user_logged_in as a where a.user='" . $_POST['accountUser'] . "' AND a.logged_in='yes1'");
  $rowdata = mysqli_num_rows($resultdata);
  if ($rowdata > 0) {
    $errorMsg = "This user already logged in.";
  } else {
    mysqli_query($conn, "INSERT INTO user_logged_in SET user='" . $_POST['accountUser'] . "', logged_in='yes'");
    if ($_POST['accountType'] == "member") {
      $database = "chatusers";
    } else if ($_POST['accountType'] == "model") {

      $database = "chatmodels";

      $staus_update = ", status='online'";
    } else if ($_POST['accountType'] == "studioop") {

      $database = "chatoperators";
    }





    $userExists = false;

    $result = mysqli_query($conn, "SELECT id,user,password,status FROM $database WHERE status!='pending' AND status!='' ");

    while ($row = mysqli_fetch_array($result)) {

      $tempUser = $row["user"];

      $tempPass = $row["password"];

      $tempId = $row["id"];



      if ($_POST['accountUser'] == $tempUser && md5($_POST['accountPassword']) == $tempPass) {

        if ($row["status"] == "blocked") {

          $userExists = true;

          $errorMsg = "Account is blocked, please contact the administrator for more details";
        } else {

          $randomnumber = rand(1000, 9999);



          $userExists = true;

          $currentTime = time();

          mysqli_query($conn, "UPDATE $database SET lastLogIn='$currentTime', loginkey=$randomnumber $staus_update WHERE id = '$tempId' LIMIT 1");

          setcookie("usertype", $database, time() + 360000);

          setcookie("id", $tempId, time() + 360000);

          session_start();
          $_SESSION["loginkey"] = $randomnumber;
          $sql = mysqli_query($conn, "UPDATE chatmodels set forced_logout='no' where id='$tempId'");
          header("Location: cp/$database/");
        }
      }
    }

    if (!$userExists) {

      $errorMsg = "Wrong Username or password";
    }
  }
} else if (isset($_GET['from']) && $_GET['from'] == "recoverpass") {

  $errorMsg = "Your new password has been sent to your email address";
} else {

  $errorMsg = "";
}
include("_main.header.php");
?>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#btn").click(function() {
      $("#loginform").submit();
    });
    $(document).keypress(function(e) {
      if (e.which == 13) {
        $("#loginform").submit();
      }
    });
  });
</script>


<style>
  .login {
    border: 1px solid #ccc;
    border-radius: 4px;
    display: table;
    margin: 68px auto;
    max-width: 422px;
    padding: 34px;
    width: 100%;
    margin-bottom: 10%;


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

  .login form input[type="text"],
  .login form input[type="password"] {
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

  ::-webkit-input-placeholder {
    /* WebKit browsers */
    color: #222;
  }

  :-moz-placeholder {
    /* Mozilla Firefox 4 to 18 */
    color: #222;
    opacity: 1;
  }

  ::-moz-placeholder {
    /* Mozilla Firefox 19+ */
    color: #222;
    opacity: 1;
  }

  :-ms-input-placeholder {
    /* Internet Explorer 10+ */
    color: #222;
  }

  .terms {
    width: 80%;
    margin: auto;
    padding: 10px;
    text-align: left;
    font-size: 16px;
    color: #fff;

    )
</style>
<div class="terms">
  <section>

    <div style="font-size:24px;">Privacy Policy</div>
    <p>&nbsp;</p>


    <div>This privacy policy (&quot;policy&quot;) will help you understand how [name] (&quot;us&quot;, &quot;we&quot;, &quot;our&quot;) uses and protects the data you provide to us when you visit and use [website] (&quot;website&quot;, &quot;service&quot;).We reserve the right to change this policy at any given time, of which you will be promptly updated. If you want to make sure that you are up to date with the latest changes, we advise youto frequently visit this page.What User Data We CollectWhen you visit the website, we maycollect the following data:•Your IP address.•Your contact information and email address.•Other information such as interests and preferences.•Data profile regarding your online behavior on our website.Why We Collect Your DataWe are collectingyour data for several reasons:•To better understand your needs.•To improve our services and products.•To send you promotional emails containing the information we think you will find interesting.•To contact you to fill out surveys and participate in other types of market research.•To customize our website according to your online behavior and personal preferences.Safeguarding and Securing the Data[name] is committed to securing your data and keeping it confidential. [name] has done all in its power to prevent data theft, unauthorized access, and disclosure by implementing the latest technologies and software, which help us safeguard all theinformation we collect online.Our Cookie PolicyOnce you agree to allow our website to use cookies, you also agree to use the data it collects regarding your online behavior (analyze web traffic, web pages you spend the most time on, andwebsites you visit).The data we collect by using cookies is used to customize our website to your needs. After we use the data for statistical analysis, the data is completely removed from our systems.Please note that cookies don't allow us to gain control of your computer in any way. They are strictly used to monitor which pages you find useful and which you do not so that we can provide a better experience for you.</div>
    <div data-page-number="1" data-loaded="true">
      <div></div>
    </div>
    <div data-page-number="2" data-loaded="true">
      <div></div>
    </div>
    <p>Terms and conditions template by WebsitePolicies.comIf you want to disable cookies, you can do it by accessing the settings of your internet browser. (Provide links for cookie settings for major internet browsers).Links to Other WebsitesOur website contains links that lead to other websites. If you click on these links [name] is not held responsible for your data and privacy protection. Visiting those websites is not governed by this privacy policy agreement. Make sure to read the privacy policy documentation of the website you go tofrom our website.Restricting the Collection of your Personal DataAt some point, you might wish to restrict the use and collection of your personal data. You can achieve this by doing the following:When you are filling the forms on the website, make sure to check if there is a box which you can leave unchecked, if you don't want to disclose your personal information.If you have already agreed to share your information with us, feel free to contact us via email and we will be more than happy to changethis for you.[name] will not lease, sell or distribute your personal information to any third parties, unless we have your permission. We might do so if the law forces us. Your personal information will be used when we need to send you promotional materials if you agree to this privacy policy. </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </section>
</div>
<?php
include("_main.footer.php");
?>
</div>