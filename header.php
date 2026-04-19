<?php
/**
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="msvalidate.01" content="C5347E9183C122392152F6B7FE4BC780" />
<meta name="google-translate-customization" content="dec065af8baaf5f5-434bb7c4b35d73ba-g67c638f9c7d92445-25"></meta>
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/bxslider.css"/>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/alphabetNav.css"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/ie.css" />
<![endif]-->
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

<!-- Google Analytics (Universal — to be replaced with GA4) -->
<script type="text/javascript">//<![CDATA[
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-213596-1']);
			_gaq.push(['_trackPageview']);
			(function () {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
//]]></script>

<!-- Cookie Consent -->
<script type="text/javascript">
    window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":"http://www.pocketdial.com/cookie-policy","theme":false};
</script>
<script type="text/javascript" src="//s3.amazonaws.com/cc.silktide.com/cookieconsent.latest.min.js"></script>

<!--[if lte IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/media.match.min.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js" type="text/javascript"></script>
<![endif]-->

<!-- Facebook Pixel -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');
fbq('init', '337132979805562');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=337132979805562&ev=PageView&noscript=1"
/></noscript>

<!-- Google Remarketing -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1071424971;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1071424971/?guid=ON&amp;script=0"/>
</div>
</noscript>

<style>
/* ============================================================
   POCKETDIAL — New Header
   ============================================================ */

/* — Reset header area — */
#branding { 
    background:none !important; 
    border:none !important;
    padding:0 !important;
    margin:0 !important;
    height:auto !important;
    min-height:0 !important;
}
#branding * { box-sizing:border-box; }
#access { display:none !important; }
#site-title { display:none !important; }
.search-form, #branding .search-form { display:none !important; }

/* — Top bar — */
.pd-topbar {
    background:#2a4a82;
    padding:6px 0;
    font-size:.78em;
}
.pd-topbar-inner {
    max-width:1060px; margin:0 auto; padding:0 20px;
    display:flex; justify-content:flex-end; gap:0;
}
.pd-topbar-inner a {
    color:rgba(255,255,255,.75);
    text-decoration:none;
    padding:0 12px;
    border-right:1px solid rgba(255,255,255,.2);
    line-height:1;
}
.pd-topbar-inner a:last-child { border-right:none; padding-right:0; }
.pd-topbar-inner a:hover { color:#fff; }

/* — Branding bar — */
.pd-brandbar {
    background:#1e3a6e;
    padding:12px 0;
}
.pd-brandbar-inner {
    max-width:1060px; margin:0 auto; padding:0 20px;
    display:flex; align-items:center; justify-content:space-between; gap:20px;
}
.pd-logo-link {
    text-decoration:none; display:flex; flex-direction:column; line-height:1;
}
.pd-logo-text {
    font-size:2em; font-weight:900; letter-spacing:-1px; color:#fff;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif;
}
.pd-logo-text span { color:#e8383e; }
.pd-logo-sub {
    font-size:.72em; color:rgba(255,255,255,.55); font-weight:400;
    margin-top:2px; letter-spacing:.2px;
}

/* — Header search — */
.pd-header-search { display:flex; gap:0; }
.pd-header-search input[type="text"],
.pd-header-search input[type="search"] {
    padding:8px 14px; border:none; border-radius:4px 0 0 4px;
    font-size:.88em; width:200px; outline:none;
    font-family:inherit; color:#333;
}
.pd-header-search button,
.pd-header-search input[type="submit"] {
    background:#e8383e; color:#fff; border:none;
    padding:8px 16px; border-radius:0 4px 4px 0;
    font-weight:700; cursor:pointer; font-size:.88em;
    font-family:inherit;
}
.pd-header-search button:hover,
.pd-header-search input[type="submit"]:hover { background:#c4262b; }

/* — Main nav — */
.pd-mainnav {
    background:#1e3a6e;
    border-top:3px solid #e8383e;
    border-bottom:3px solid #e8383e;
}
.pd-mainnav-inner {
    max-width:1060px; margin:0 auto; padding:0 20px;
    display:flex; align-items:center;
}
.pd-mainnav-home {
    background:#e8383e;
    color:#fff !important;
    padding:10px 14px !important;
    font-size:1em !important;
    text-decoration:none;
    display:flex; align-items:center;
    flex-shrink:0;
}
.pd-mainnav-home:hover { background:#c4262b !important; }

/* Override WordPress nav menu styles */
.pd-mainnav ul.menu,
.pd-mainnav .menu {
    display:flex !important;
    flex-direction:row !important;
    list-style:none !important;
    margin:0 !important; padding:0 !important;
    background:none !important;
}
.pd-mainnav ul.menu li,
.pd-mainnav .menu li {
    position:relative;
    margin:0 !important; padding:0 !important;
    background:none !important;
    border:none !important;
    float:none !important;
}
.pd-mainnav ul.menu li a,
.pd-mainnav .menu li a {
    display:block !important;
    padding:11px 16px !important;
    color:rgba(255,255,255,.88) !important;
    text-decoration:none !important;
    font-size:.85em !important;
    font-weight:600 !important;
    white-space:nowrap;
    background:none !important;
    border:none !important;
    line-height:1.3 !important;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif !important;
}
.pd-mainnav ul.menu li a:hover,
.pd-mainnav .menu li a:hover {
    color:#fff !important;
    background:rgba(255,255,255,.1) !important;
}
.pd-mainnav ul.menu li ul,
.pd-mainnav .menu li ul { display:none !important; }

/* — Breadcrumb — */
#breadcrumbs {
    background:#f7f7f7;
    border-bottom:1px solid #e0e0e0;
    padding:7px 0;
    font-size:.82em;
    color:#666;
}
#breadcrumbs .pd-bc-inner {
    max-width:1060px; margin:0 auto; padding:0 20px;
}
#breadcrumbs a { color:#666; text-decoration:none; }
#breadcrumbs a:hover { color:#e8383e; text-decoration:underline; }
#breadcrumbs span[aria-label="breadcrumb separator"] { margin:0 4px; }

/* — Mobile — */
.pd-mobile-toggle {
    display:none;
    background:none; border:none;
    color:#fff; font-size:1.4em; cursor:pointer;
    padding:8px; margin-left:auto;
}
@media(max-width:768px) {
    .pd-topbar { display:none; }
    .pd-logo-text { font-size:1.5em; }
    .pd-header-search input { width:130px; }
    .pd-mobile-toggle { display:block; }
    .pd-mainnav-inner { flex-wrap:wrap; }
    .pd-mainnav ul.menu,
    .pd-mainnav .menu { 
        flex-direction:column !important; 
        width:100%;
        display:none !important;
    }
    .pd-mainnav ul.menu.pd-open,
    .pd-mainnav .menu.pd-open { display:flex !important; }
    .pd-mainnav ul.menu li a,
    .pd-mainnav .menu li a { border-bottom:1px solid rgba(255,255,255,.1) !important; }
}
</style>

</head>

<body <?php body_class(); ?>>

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="page" class="hfeed">
    <header id="branding" role="banner">

        <!-- Top bar — secondary nav links -->
        <div class="pd-topbar">
            <div class="pd-topbar-inner">
                <?php wp_nav_menu( array(
                    'theme_location' => 'secondary',
                    'container'      => false,
                    'menu_class'     => '',
                    'items_wrap'     => '%3$s',
                    'walker'         => new class extends Walker_Nav_Menu {
                        function start_el(&$output, $item, $depth=0, $args=null, $id=0) {
                            $url = $item->url ?: '#';
                            $output .= '<a href="' . esc_url($url) . '">' . esc_html($item->title) . '</a>';
                        }
                        function start_lvl(&$output,$depth=0,$args=null){}
                        function end_lvl(&$output,$depth=0,$args=null){}
                        function end_el(&$output,$item,$depth=0,$args=null){}
                    }
                ) ); ?>
            </div>
        </div>

        <!-- Branding bar — logo + search -->
        <div class="pd-brandbar">
            <div class="pd-brandbar-inner">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="pd-logo-link">
                    <div class="pd-logo-text">POCKET<span>DIAL</span></div>
                    <div class="pd-logo-sub">Instant Low Cost International Calls</div>
                </a>
                <div class="pd-header-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>

        <!-- Main nav -->
        <div class="pd-mainnav">
            <div class="pd-mainnav-inner">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="pd-mainnav-home" aria-label="Home">🏠</a>
                <?php wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'menu',
                ) ); ?>
                <button class="pd-mobile-toggle" onclick="var m=document.querySelector('.pd-mainnav .menu');m.classList.toggle('pd-open');" aria-label="Menu">☰</button>
            </div>
        </div>

    </header><!-- #branding -->

    <div id="main" class="group">
        <div id="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <div class="pd-bc-inner">
            <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
            </div>
        </div>