<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.2/css/materialize.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }

    #card.row {
      text-align: center;
    }

    .row .col1 {
      display: inline-block;
      padding: 1px 1px 1px 1px;

    }

    .card {
      margin: 0px;
    }

    #search {
      color: #fff;
    }

    input[type=search] {
      border-bottom: 1px solid #fff !important;
    }

    .btn:hover {
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    .card-title {
      padding: 0px !important;
      font-size: 15px !important;
    }

    .card-age {
      float: right !important;
      padding: 0px 3px 0px 0px !important;
    }

    .card-name {
      float: left !important;
      padding: 0px 0px 0px 3px !important;
    }

    span.card-title {

      display: block;
      background: #000;
      background: rgba(0, 0, 0, 0.35);
      color: #FFF;
      width: 100%;

    }

    .bluecs {
      background-color: #05B0FA !important;
    }

    .pinkcs {
      background-color: #FB41B5 !important;
    }

    .greencs {
      background-color: #91BD09 !important;
    }

    .dpinkcs {
      background-color: #D7399C !important;
    }

    .sidenav-overlay {
      background-color: transparent !important;
    }

    #nav-mobile li.search .search-wrapper {
      color: #777;
      margin-top: -1px;
      border-top: 1px solid rgba(0, 0, 0, 0.14);
      -webkit-transition: margin .25s ease;
      transition: margin .25s ease
    }

    #nav-mobile li.search .search-wrapper.focused .search-results:not(:empty) {
      border-bottom: 1px solid rgba(0, 0, 0, 0.14)
    }

    #nav-mobile li.search .search-wrapper input#search {
      color: #777;
      display: block;
      font-size: 16px;
      font-weight: 300;
      width: 100%;
      height: 62px;
      margin: 0;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      padding: 0 45px 0 30px;
      border: 0
    }

    #nav-mobile li.search .search-wrapper input#search:focus {
      outline: none;
      -webkit-box-shadow: none;
      box-shadow: none
    }

    #nav-mobile li.search .search-wrapper i.material-icons {
      position: absolute;
      top: 21px;
      right: 10px;
      cursor: pointer
    }

    #nav-mobile li.search .search-results {
      margin: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.14);
      background-color: #fff
    }

    #nav-mobile li.search .search-results a {
      font-size: 12px;
      white-space: nowrap;
      display: block
    }

    #nav-mobile li.search .search-results a:hover,
    #nav-mobile li.search .search-results a.focused {
      background-color: #eee;
      outline: none
    }



    /*  This is my CSS   */

    .bar2-wrapper {
      padding 5px;




    }

    .bar2 {
      width: 100%;
      height: 45px;
      background-color: #0099FF;
      position: fixed;
      padding: 5px;
      z-index: 50;



    }




    .model-button {
      float: right;
      width: 140px;
      height: 30px;

      color: #FFF;
      background-color: #F341D5;
      border-radius: 3px;
      color: FFF;
      padding: 3px;
      margin-right: 50px;
      vertical-align: middle;

    }



    /*  End of my CSS  */
  </style>
</head>

<body>

  <div class="navbar-fixed">

    <nav class="pinkcs" role="navigation">

      <div class="nav-wrapper">
        <div class="row" style="padding-left: 1.5%; padding-right: 1.5%;"><a id="logo-container" href="#" class="brand-logo">LivePlayhouse</a>
          <ul class="right hide-on-med-and-down">
            <li>
              <form><input id="search" name="q" type="search" class=""></form>
            </li>
            <li><a href="#" id="searchlink"><i class="material-icons">search</i></a></li>
            <!--<li><a class="dropdown-trigger" href="#" data-target="dropdown1"><i class="material-icons">view_module</i></a></li>-->
            <li><a class="waves-effect waves-light bluecs btn">SIGN IN</a></li>
            <li><a class="waves-effect waves-light greencs btn">JOIN NOW FREE</a></li>
          </ul>








          <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>


        </div>
      </div>


  </div>


  <div class="hide-on-med-and-down">
    <div class="bar2-wrapper"></div>
    <div class="bar2" height="35px">

      <div class="model-button" align="right">
        <div align="center">MODEL SIGNUP</div>
      </div>



    </div>
  </div>

  <p>&nbsp;</p>















  <div class="row">
    <div class="col l2 hide-on-med-and-down">
      <div class="collection">
        <a href="#!" class="collection-item">Asian</a>
        <a href="#!" class="collection-item">Asian</a>
        <a href="#!" class="collection-item">Asian</a>
        <a href="#!" class="collection-item">Asian</a>

        <a href="#!" class="collection-item">Asian</a>
        <a href="#!" class="collection-item">Asian</a>
        <a href="#!" class="collection-item">Asian</a>
      </div>

    </div>
    <div class="row" id="card">
      <div class="col s12 l10">
        <?php
        foreach (range(1, 36) as $o) {
          echo '   <div class="col1" style="width: 250px;">
      <div class="card" style="">
        <div class="card-image">
          <img class="responsive-img" style="" src="https://liveplayhouse.com/models/Lindsay/thumbnail.jpg">
          <span class="card-title"><span class="card-name">DeepLoverz</span><span class="card-age">24/F</span></span>
        </div>
   
    </div></div>';
        } ?>
      </div>
    </div>
  </div>
  <footer class="page-footer bluecs">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        demo by <a class="orange-text text-lighten-3" href="http://fluffvision.com">fluffvision ent</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery.min.js"></script>


  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.2/js/materialize.min.js"></script>
  <!--  <script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>-->

  <script>
    $(document).ready(function() {
      $("#search").hide();
      $('.collapsible').collapsible();
      $('.sidenav').sidenav();
      $('.dropdown-trigger').dropdown();



      $("#searchlink").click(function() {
        $("#search").show();
        $("#search").focus();
      });
      $('#search').bind('blur', function() {
        $(this).hide();
      });

    });
  </script>
</body>

</html>