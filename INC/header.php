<header class="clearfix">
  <?php 
	if ($sectionName=='Home') { ?>
      <div id="logo"> <img src="images/logo.png" alt="UpdikeGaspari logo" /> </div>
  <?php ;} else {	?>

	  
      <div id="logo"> <a href="/" title="back to home page"><img src="images/logo.png" alt="UpdikeGaspari logo" /></a> </div>
  <?php 
	  
	  }
	?>
  <!-- /logo -->
  <div id="icons"> <a href="http://www.twitter.com" target="_blank" title="find us on Twitter"><img src="images/icons/twitterIcon.png" alt="Twitter" /></a> <a href="http://www.facebook.com/home.php#!/UpdikeGaspari" target="_blank" title="find us on Facebook"><img src="images/icons/facebookIcon.png" alt="Facebook" /></a> </div>
  <!-- /icons -->
  <nav id="mainNav">
    <ul>
      <li><a id="aAbout" href="aboutUs.php">about us</a> </li>
      <li><a id="aCurrentListings" href="properties/current">current listings</a> </li>
      <li><a id="aSearchHomes" href="searchForHomes.php">search for homes</a> </li>
      <li><a id="aSold" href="properties/sold">homes sold</a> </li>
      <li><a id="aBuyers" href="buyers.php">buyers</a> </li>
      <li><a id="aSellers" href="sellers.php">sellers</a> </li>
      <li><a id="aContact" href="contact.php">contact</a> </li>
    </ul>
  </nav>
  <!-- /navigation -->
  <?php 
	if ($sectionName=='About') { ?>
  <nav id="subNav">
    <ul>
      <li class="subNavTitle"><span>read their bios:</span></li>
      <li class="aboutNav1 first"><a href="aboutUs.php">about us</a> </li>
      <li class="aboutNav2"><a href="aboutDavid.php">about david</a> </li>
      <li class="aboutNav3"><a href="aboutKevin.php">about kevin</a> </li>
      <li class="aboutNav4"><a href="testimonials.php">testimonials</a> </li>
      <li class="aboutNav5"><a href="aboutWindermere.php">Windermere</a> </li>
    </ul>
  </nav>
  <!-- /navigation -->
  <?php ;} else {}
	?>
</header>
<!-- /header --> 
