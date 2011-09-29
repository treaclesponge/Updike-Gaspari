<?php 
$sectionName="About";
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
    <div id="mainImage"><img src="images/about_us.jpg" class="mainImage" alt="David Updike and Kevin Gaspari" /></div>
        <div class="content">
        <h2>Updike + Gaspari + Windermere</h2>
          <p><strong>David Updike and Kevin Gaspari are a real estate team specializing in residential real estate listings and sales in Seattle and its close in communities.</strong> </p>
          <p>Investing in Seattle is the right thing to do  and we think now is a great time to do it.&nbsp;  Seattle offers so many economic, environmental and cultural advantages,  not to mention the awe inspiring scenery, that it is not surprising so many  people continue to move here and invest in real estate.&nbsp; Property values continue to increase  reflecting the demand for housing.&nbsp; While  other parts of the United States are seeing a slight slow down in their real  estate market, Seattle's outlook is bright and strong.</p>
          <p>But who to work with you might ask?&nbsp; In Seattle's crowded field of real estate  representatives, our skills as educators to our clients and solid advocates for  their positions, set us apart from our peers.&nbsp;  We are not newcomers to this profession.&nbsp;  Over eighteen years of full-time experience in Seattle's market has given  us unsurpassed market knowledge and has helped us build a premiere network of  real estate professionals.&nbsp; Our knowledge  and our network combine to give our clients the competitive edge they need to  successfully buy and sell real estate.&nbsp;  We can serve you in every aspect of real estate: residential, new  construction, co-ops and condominiums, relocation and property management.</p>
          <p>Our mission is to deliver uncompromising  personal service in every aspect of the real estate process with integrity and  honesty.&nbsp; We want our clients to choose  our team for representation with complete confidence.&nbsp; And when the deal is done we want our clients  to have 100% satisfaction with the service we provided.</p>
        </div>
        <!-- /content --> 
          </section>
    <!-- /section:mainContent -->
    <section id="rightCol" role="main">
      <div id="testimonials" class="contentBlocks">
        <h2><span>First time buyer?</span></h2>
       <div class="content">
            <p>David and Kevin have helped countless first time buyers become seasoned home owners.</p>
            <p>They can help you too.</p>
          <!--  <p class="readMore"><a class="button" href="#"><span>Read more</span></a> </p>--> 
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