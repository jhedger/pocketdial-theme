<?php
add_action('get_header', 'my_filter_head');  function my_filter_head() { 	remove_action('wp_head', '_admin_bar_bump_cb'); }

register_nav_menus( array(  
  'primary' => __( 'Primary Navigation', 'twentyeleven' ),  
  'secondary' => __('Secondary Navigation', 'twentyeleven'), 
  'footer' => __('Footer Navigation', 'twentyeleven'),
  'social' => __('Social Navigation', 'twentyeleven')
) );  


function recentPosts() {
    $rPosts = new WP_Query();
    $rPosts->query('showposts=1');
        while ($rPosts->have_posts()) : $rPosts->the_post(); ?>
            <li>
                <a href="<?php the_permalink();?>"><?php the_post_thumbnail('recent-thumbnails'); ?></a>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                <?php the_excerpt(); ?>
                <a class="more" href="<?php the_permalink();?>">Read more</a>
            </li> 
        <?php endwhile; 
    wp_reset_query();
}

/* Shortcodes */
function container( $atts, $content = null ) {  
    return '<div class="add_top_border">'.do_shortcode($content).'</div>';  
}  
add_shortcode("container", "container");

function group( $atts, $content = null ) {  
    return '<div class="group">'.do_shortcode($content).'</div>';  
}  
add_shortcode("group", "group");

function columnquarter( $atts, $content = null ) {  
    return '<div class="column_quarter">'.$content.'</div>';  
}  
add_shortcode("columnquarter", "columnquarter");

function columnthird( $atts, $content = null ) {  
    return '<div class="column_third">'.$content.'</div>';  
}  
add_shortcode("columnthird", "columnthird");

function columnhalf( $atts, $content = null ) {  
    return '<div class="column_half">'.$content.'</div>';  
}  
add_shortcode("columnhalf", "columnhalf");

function addline( $atts, $content = null ) {  
    return '<div class="addline">'.$content.'</div>';  
}  
add_shortcode("addline", "addline");

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;




?>