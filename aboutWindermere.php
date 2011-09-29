<?php 
$sectionName="About";
$pageName="About Kevin Gaspari";
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
      <div id="mainImage"> 
        <img src="images/windermere.jpg" alt="Windermere" width="351" height="397" class="mainImage" />
      </div>
      <div class="content">
        <h2>Windermere Real Estate</h2>
        <p>
        <span class="firstLetter">W</span>indermere Real Estate is the largest and most powerful real estate company in the Pacific Northwest. Windermere commands the largest market share of both homes listed and homes sold when compared to any other company working in the same geographic market. </p>
        <p>And it all started in 1972 when John W. Jacobi purchased a small eight agent real estate office on Sand Point Way in the Windermere neighborhood of Seattle. </span></p>
        <p>By 1993 this one office had grown to over 100 offices and continues to grow with offices in almost every state on the west coast as well as Canada, the desert states, and soon Hawaii and Alaska. </span></p>
        <p>However, Windermere has not forgotten its roots. That original office in Seattle remains the company headquarters today. </p>
      </div>
      <!-- /content --> 
    </section>
    <!-- /section:mainContent -->
    <section id="rightCol" role="main">
      <div id="testimonials" class="contentBlocks">
        <h2><span>Ten reasons to choose&hellip;</span></h2>
        <div class="content">
          <ol>
              <li>Mauris accumsan enim augue, id iaculis nisi.</li>
              <li>Aenean vel dolor quam, in pulvinar mauris.</li>
              <li>Praesent in odio dapibus mi consequat sollicitudin.</li>
              <li>Ut at ligula a mi tempor consequat in sed eros.</li>
              <li>Nulla a nulla nec eros dictum bibendum.</li>
          </ol>
          <p class="readMore"><a class="button" href="http://www.windermere.com" target="_blank"><span>Windermere website</span></a> </p>
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