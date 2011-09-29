<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'lee@treaclesponge.com.com'; //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: Updike Gaspari <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}

$sectionName="Contact";
$pageName="";
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
      <div id="mainImage"> <img src="images/contact.jpg" alt="" width="351" height="302" class="mainImage" /> </div>
      <div class="content">
        <h2>Contact David Updike and Kevin Gaspari</h2>
				<?php if(isset($hasError)) { //If errors are found ?>
				<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
				<?php } ?>
				<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
				<h3>&nbsp;<br />
				Email Successfully Sent!</h3>
				<p>Thank you <strong><?php echo $name;?></strong> contacting David Updike &amp; Keving Gaspari. Your email was successfully sent and I will be in touch with you soon.</p>
				<?php } ?>
				<?php if($emailSent == false) { //If email is NOT sent ?>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
						<label for="contactname">Name:</label>
						<input type="text" name="contactname" id="contactname" value="" class="required" />
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" value="" class="required email" />
						<label for="subject">Subject:</label>
						<input type="text" name="subject" id="subject" value="" class="required" />
						<label for="message">Message:</label>
						<textarea name="message" id="message" class="required"></textarea>
					<input type="submit" id="submit" value="Send Message" name="submit" />
				</form>
				<?php } ?>
      </div>
      <!-- /content --> 
    </section>
    <!-- /section:mainContent -->
    <section id="rightCol" role="main">
      <div id="testimonials" class="contentBlocks">
        <h2><span>Ways to Contact us:</span></h2>
        <div class="content">
          <dl>
            <dt>
              Office:
            </dt>
            <dd>
              206.448.6000
            </dd>
            <dt>
              Fax:
            </dt>
            <dd>
              206.623.6533
            </dd>
            <dt>
              Mail:
            </dt>
            <dd>
              Windermere Real Estate<br />
              214 East Galer Street<br />
              Suite 300<br />
              Seattle, WA<br /> 98102-3716
            </dd>
          </dl>
        <p class="readMore"><a href="http://maps.google.com/maps?f=q&hl=en&q=214+East+Galer+Street,+seattle&ll=47.633412,-122.325468&spn=0.026201,0.086517&om=1" class="button"><span>View Map</span></a> </p>
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