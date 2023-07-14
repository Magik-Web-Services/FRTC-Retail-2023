<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style3.css">
</head>

<foot>
  <table width="100%" height="251" border="0" cellspacing="10">
    <tr>
      <td height="231" bgcolor="#000000">
        <div align="center">
          <table width="75%" border="0">
            <tr>
              <td>
                <div class="footText1" align="center">
                  <p>Welcome to the best place to broadcast yourself or view other broadcasters. Sign up and broadcast LIVE today! <br />
                  </p>
                  <div class="adults">LIVE BROADCASTERS 24/7 </div>
                  <br />
                  <a href="registration/user.php" alt="Join live video chat and interact with webcam broadcasters today at <?php echo $sitename ?>." title="Live interactive webcam site">Join our community today and enjoy 24/7 live webcams.</a>
                </div>
              </td>
            </tr>
          </table>
          <table width="75%" border="0" cellspacing="10">
            <tr>
              <td>
                <div class="links" align="center">
                  <p>&nbsp;</p>
                  <p><a href="index.php">Home</a> <a href="broadcaster.php">Broadcaster Login</a> <a href="terms.php">Terms of Service</a> <a href="privacy.php">Privacy Policy</a> <a href="law.php">2257 Record Keeping Statement</a></p>
                </div>
              </td>
            </tr>
          </table>
          <br />
          <table width="75%" border="0" cellspacing="10" bgcolor="#000000">
            <tr>
              <td bgcolor="#000000">
                <div class="links" align="center">
                  <p><a href="#">Copyright © <?php echo $copyrightYear ?> <?php echo $sitename ?>. All Rights Reserved. </a><a href="#"></a></p>
                </div>
              </td>
            </tr>
          </table>
          <p><br />
          </p>
        </div>
      </td>
    </tr>
  </table>
</foot>
<script>
  $(document).ready(function() {
    $("#search").hide();
  });
</script>
<script>
  jQuery(document).ready(function() {
    jQuery('.drop-menu-mob').click(function() {
      $(this).closest('.drop-data-mob').siblings().find('.drop-data-mob').slideUp();
      $(this).siblings('.drop-data-mob').slideToggle("slow");
    });
    $('.toggle-btn').click(function() {
      $(".mobile-menu").toggleClass("transparent-bac_colour");
      $('.toggle-mob-menu').toggle();
    });
  });
</script>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
</body>
</html>
</html>