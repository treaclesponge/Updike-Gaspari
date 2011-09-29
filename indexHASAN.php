<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml/DTD/xhtml-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>David Updike and Kevin Gaspari</title>
<link rel="shortcut icon" href="favicon.ico" />
<?php require_once('INC/scripts.html'); ?>
<style type="text/css" media="all">
/* Home Page */
#top {
		background:url(/images/banners/banner_blank.jpg) 0 0 no-repeat;
}

.flash /*flash movie*/ {
		float:right;
		margin:0px;
		margin-top:-10px
}

#content {
		height:447px;
}

.frame {
		border:0px solid #000;
		padding:10px 0 0 0;
		width:100%
}

.block1 {
		height:400px;
		width:270px;
		float:left;
		overflow:hidden
}

#mainContent p {
		font-size:13px;
		margin:0;
		text-align:justify;
		padding:0
}

.blueCaps {
		color:#9cf;
		font-variant:small-caps;
		line-height:23px;
		font-size:14px;
		font-weight:bolder
}

.orangeSans {
		color:#f90;
		font-variant:normal;
		line-height:23px;
		font-size:13px;
		font-weight:bolder;
		font-family:Verdana, Arial, Helvetica, sans-serif;
}

.blueSans {
		color:#9cf;
		font-variant:normal;
		line-height:23px;
		font-size:13px;
		font-weight:bolder;
		font-family:Verdana, Arial, Helvetica, sans-serif;
}

.greySans {
		color:#666;
		font-variant:normal;
		line-height:23px;
		font-size:13px;
		font-weight:bolder;
		font-family:Verdana, Arial, Helvetica, sans-serif;
}

.blackBold {
		color:#000;
		font-weight:bold
}

.greenSans {
		color:#A5C5A6;
		font-variant:normal;
		line-height:23px;
		font-size:13px;
		font-weight:bolder;
		font-family:Verdana, Arial, Helvetica, sans-serif;
}

.blueCourierBold {
		color:#9cf;
		font-family:"Courier New", Courier, mono;
		line-height:23px;
		font-size:13px;
		font-weight:bolder
}

.greySerif {
		color:#666;
		font-family:Georgia, "Times New Roman";
		line-height:23px;
		font-size:11px;
		font-weight:bold;
		font-style:italic;
}

.greenSerif {
		color:#f90;
		font-family:Georgia, "Times New Roman";
		line-height:23px;
		font-size:12px;
}

.greyCourier {
		color:#666;
		font-family:"Courier New", Courier, mono;
		line-height:23px;
		font-size:14px;
		font-style:italic;
}

.orangeSerif {
		color:#f90;
		font-family:Georgia, "Times New Roman";
		line-height:23px;
		font-size:13px;
		font-style:oblique;
		font-stretch:expanded;
}

.greenSerif {
		color:#A5C5A6;
		line-height:23px;
}
</style>
<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<div id="outerWrapper">
  <?php require_once('INC/topBanner.html'); ?>
  <!-- /topBanner -->
  <div id="innerWrapper">
    <?php require_once('INC/contactBar.html'); ?>
    <!-- /contactBar -->
    <div id="mainContent">
      <?php
	  require_once('INC/db.php');
	  $propId = 257;
	  $query = "SELECT * FROM cake_properties WHERE id = $propId";
	  $result = mysql_query($query);
	  if($row = mysql_fetch_object($result)) {
         echo 'Neighborhood: ' . $row->neighborhood . '<br /><br />';
		 echo 'Descriptor: ' . $row->descriptor . '<br /><br />';
		 echo 'Text: ' . $row->text . '<br /><br />';
		 echo 'Price: $' . number_format($row->price, 0, '', ',') . '<br /><br />';
		 echo 'Read more: <a href="properties/detail/' . $propId . '">Read more</a><br /><br />';
		 
		 // Images
		 $directory = 'images/newProperties/main/' . $propId;
		 $dh  = opendir($directory);
         while( false !== ($filename = readdir($dh)) ) {
		    if($filename != '.' && $filename != '..') {
                $files[] = $filename;
			}
         }
         sort($files);
		 print_r($files);
      }
	  ?>
      <?php require_once('INC/randomText.php'); ?>
      <div class="flash">
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','500','height','420','title','UpdikeGaspari','src','flash/home_page_v8','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','flash/home_page_v8' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="500" height="420" title="UpdikeGaspari">
          <param name="movie" value="flash/home_page_v8.swf" />
          <param name="quality" value="high" />
          <embed src="flash/home_page_v8.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="500" height="420"></embed>
        </object></noscript>
      </div>
      <!-- end of flash -->
    </div>
    <!-- end of mainContent -->
    <!-- /mainContent -->
  </div>
  <!-- /innerWrapper -->
  <?php require_once('INC/navigation.html'); ?>
  <!-- /closure -->
</div>
<!-- /outerWrapper -->
<?php require_once('INC/footer.php'); ?>
<!-- /footer -->
</body>
</html>
