<?php 
$sectionName="About";
$pageName="Testimonials";
$className = strtolower($sectionName);
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Updike Gaspari | Seattle Real Estate</title>
<meta name="description" content="">
<?php require_once('INC/meta.php'); ?>
<?php require_once('INC/headerScripts.php'); ?>
</head>

<body class="<?php echo $className;?>">
<div id="containerTop">&nbsp;</div>
<div id="outerWrapper">
  <div id="innerWrapper">
    <?php require_once('INC/header.php'); ?>
    <section id="mainContent" role="main">
      <div id="mainImage"> testimonials goes here </div>
      <div class="content">
        <h2>Testimonials</h2>
        <p> Our clients are responsible for our success.  We'd be nothing without them and we both take great pride in the number of repeat clients we have had over the years, as well as the numerous times they have referred us to their friends, co-workers and relatives. </p>
        <p>Whether they are buying a small fixer or selling a large estate, we endeavor to provide all of our clients with the highest level of representation possible.  Why not take a moment to scroll through their comments and see how they think we did? </p>
      </div>
      <!-- /content --> 
    </section>
    <!-- /section:mainContent -->
    <section id="rightCol" role="main">
      <div id="testimonials" class="contentBlocks">
        <h2><span>From our Customers&hellip;</span></h2>
        <div class="content">
          <blockquote>
            <p>How do they pull it off is anyone's guess!<img src="images/quotes/closeQuotes.png" alt="close quote" /></p>
          </blockquote>
          <p class="readMore"><a class="button" href="#"><span>Read more</span></a> </p>
        </div>
        <!-- /content --> 
        <!-- /content --> 
      </div>
      <!-- /twitter --> 
      
    </section>
    <!-- /section:rightCol --> 
  </div>
  <!-- /innerWrapper -->
  <?php require_once('INC/footer.php'); ?>
  
  <!-- /containerBottom --> 
</div>
<!-- /outerWrapper -->
<?php require_once('INC/credit.php'); ?>
<?php require_once('INC/closure.php'); ?>
</body>
</html>