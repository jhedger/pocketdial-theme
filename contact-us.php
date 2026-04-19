<?php
/*
Template Name: Contact Us
*/
?>


<?php get_header(); ?>

		<div id="primary">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php //comments_template( '', false ); ?>

				<?php endwhile; // end of the loop. ?>

	
		</div><!-- #primary -->

<?php get_footer(); ?>
