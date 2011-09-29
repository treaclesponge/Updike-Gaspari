<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
<script src="js/libs/jquery.tweet.js"></script>
<script>
		jQuery(function($){
			$("#twitter_update_list").tweet({
			join_text:false,
			avatar_size: 32,
			count: 4,
			username: [ "DTseattleRE"],
			loading_text: "searching twitter...",
			refresh_interval: 60
			});
		});
    </script>
<!-- scripts concatenated and minified via ant build script-->
<script defer src="js/plugins.js"></script>
<script defer src="js/script.js"></script>
<!-- end scripts-->

<!-- galleria -->
<script src="js/libs/jquery.galleriffic.js"></script>
<script src="js/libs/jquery.opacityrollover.js"></script>
<!-- We only want the thunbnails to display when javascript is disabled -->
<script>
			jQuery(document).ready(function($) {
				// We only want these styles applied when javascript is enabled
				$('div.navigation').css({'width' : '300px', 'float' : 'left'});
				$('div.galleryContent').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				
				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     3500,
					numThumbs:                 15,
					preloadAhead:              10,
					enableTopPager:            false,
					enableBottomPager:         false,
					maxPagesToShow:            7,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          false,
					renderNavControls:         false,
					enableHistory:             false,
					autoStart:                 true,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						this.fadeTo('fast', 1.0);
					}
				});
			});
		</script>
<!-- end galleria-->

<!-- cufon -->
<script src="js/libs/cufon/cufon-yui.js"></script>
<script src="js/libs/cufon/Futura_Std_500-Futura_Std_700.font.js"></script>
<script type="text/javascript">
Cufon.replace(['h1','h2','h3','h4','nav ul li','p.price','blockquote p','nav ul li a','#contactform label', ], {
  hover: true, hoverables: { a: true } }); 

Cufon.replace('h1', {textShadow: '1px 1px 2px #222222'}); 

Cufon.replace('body.home #mainContent h2', {textShadow: '1px 1px 2px #222222'}); 

Cufon.replace('#rightCol h2', {textShadow: '1px 1px 2px #222222'}); 

</script>
<!-- end cufon-->

<script> // Change UA-XXXXX-X to be your site's ID
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>

<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->