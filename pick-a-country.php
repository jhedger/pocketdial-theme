<?php
/*
Template Name: Pick a Country
*/
?>

<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php //comments_template( '', false ); ?>

				<?php endwhile; // end of the loop. ?>

		<div class="group">
    		<ul class="pick_a_country"><?php include('country_list.php'); ?></ul>
 		</div>
          </div><!-- #content -->
            <?php include('sidebarExtras.php'); ?>
		</div><!-- #primary -->

<?php get_footer(); ?>
