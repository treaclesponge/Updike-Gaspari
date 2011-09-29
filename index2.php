<?php 
$sectionName="Home";
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
    <section id="featureProperty" role="main">
      <div id="featureContent">
        <h1><span>Denny/Blaine</span></h1>
        <div class="content clearfix">
          <h2>Exceptional Custom Home</h2>
          <p>Timeless mid-century design circa 1956, meticulously restored and polished for 21st century comfort. Exposed beams & wood clad ceilings accentuate the angled roof line spanning the 32 foot living room&hellip;</p>
          <p class="price">$1,500,000</p>
          <p class="readMore"><a class="button" href="#"><span>Read more</span></a> </p>
          <div id="thumbs" class="navigation">
            <ul class="thumbs noscript">
              <li> <a class="thumb" href="images/propID257-01.jpg" title="Title #1"><span>Title #1</span></a> </li>
              <li> <a class="thumb" href="images/propID257-02.jpg" title="Title #2"><span>Title #2</span></a> </li>
              <li> <a class="thumb" href="images/propID257-03.jpg" title="Title #3"><span>Title #3</span></a> </li>
              <li> <a class="thumb" href="images/propID257-04.jpg" title="Title #4"><span>Title #4</span></a> </li>
              <li> <a class="thumb" href="images/propID257-05.jpg" title="Title #5"><span>Title #5</span></a> </li>
              <li> <a class="thumb" href="images/propID257-06.jpg" title="Title #6"><span>Title #6</span></a> </li>
            </ul>
          </div>
        </div>
        <!-- /content --> 
      </div>
      <!-- /featureContent --> 
      <!-- Start Minimal Gallery Html Containers -->
      <div id="gallery" class="galleryContent">
        <div class="slideshow-container">
          <div id="loading" class="loader"></div>
          <div id="slideshow" class="slideshow"></div>
        </div>
      </div>
      
      <!-- End Minimal Gallery Html Containers --> 
      
    </section>
    <section id="mainContent" role="main">
      <div id="mainImage"><img src="images/updikeGaspari.jpg" class="mainImage" alt="David Updike and Kevin Gaspari" /></div>
      <div id="aboutUs" class="contentBlocks">
        <h2><span>Updike + Gaspari + Windermere</span></h2>
        <div class="content">
          <p>David Updike and Kevin Gaspari are a real estate team specializing in residential real estate listings and sales in Seattle and its close in communities.</p>
          <h4>Integrity and Honesty</h4>
          <p>Our skills as educators to our clients and solid advocates for their positions, set us apart from our peers.</p>
          <p class="readMore"><a class="button" href="#"><span>Read more</span></a> </p>
        </div>
        <!-- /content --> 
      </div>
      <!-- /aboutUs -->
      <div id="testimonials" class="contentBlocks">
        <h2><span>What our clients say&hellip;</span></h2>
        <div class="content">
          <blockquote>
            <p>these boys sure are great<img src="images/quotes/closeQuotes.png" alt="close quote" /></p>
          </blockquote>
          <p class="readMore"><a class="button" href="#"><span>Read more</span></a> </p>
        </div>
        <!-- /content --> 
      </div>
      <!-- /testimonials --> 
    </section>
    <!-- /section:mainContent -->
    <section id="rightCol" role="main">
      <div id="twitter" class="contentBlocks">
        <h2><span>From Twitter</span></h2>
        <div class="content">
          <div id="twitter_update_list" class="query"></div>
        </div>
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