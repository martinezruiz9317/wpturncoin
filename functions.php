<?php

/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function turncoin_child_enqueue_parent_style()
{
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme('OceanWP');
	$version = $theme->get('Version');
	// Load the stylesheet
	wp_enqueue_style('fullpage-css', get_stylesheet_directory_uri() . '/extensions/fullpage/fullpage.css', array(), $version);
	wp_enqueue_style('turncoin-flex-style', get_stylesheet_directory_uri() . '/dist/css/flex.css', array(), $version);
	wp_enqueue_style('turncoin-style', get_stylesheet_directory_uri() . '/style.css', array('oceanwp-style'), $version);
	
	wp_enqueue_script('slickjs', get_stylesheet_directory_uri() . '/extensions/fullpage/fullpage.js', array(), $version, false);
	wp_enqueue_script('TweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js', array(), $version, true);
	wp_enqueue_script('turncoin-js', get_stylesheet_directory_uri() . '/js/main.js', array(), $version, true);
}
add_action('wp_enqueue_scripts', 'turncoin_child_enqueue_parent_style', 200);

add_action('ocean_after_blog_entry_title', 'dmnAddDateAfterTitle');
function dmnAddDateAfterTitle()
{
	echo '<div class="postentry-date">' . get_the_date() . '</div>';
}

if (!function_exists('read_more_on_thumbnail')) {
	function read_more_on_thumbnail()
	{
		$style = get_theme_mod('ocean_blog_style', 'large-entry');
		if ('thumbnail-entry' == $style) {
			return get_template_part('partials/entry/readmore');
		}
	}
	add_action('ocean_after_blog_entry_content', 'read_more_on_thumbnail');
}

/**
 * Change the Continue Reading text
 */
function myprefix_post_readmore_link_text()
{
	return '<span>MORE</span>';
}
add_filter('ocean_post_readmore_link_text', 'myprefix_post_readmore_link_text');

add_action('ocean_after_single_post_content', 'dmnAddBackBtn');
function dmnAddBackBtn()
{
	if (is_singular('event')) {
		echo '<div class="back-btn"><a class="my-btn" href="' . get_site_url() . '/events/"><span>BACK</span></a></div>';
	}
	if (is_singular('post')) {
		echo '<div class="back-btn"><a class="my-btn" href="' . get_site_url() . '"><span>BACK</span></a></div>';
	}
}

add_action('ocean_before_single_post_title', 'dmnAddGallery');
function dmnAddGallery()
{
	echo '<div class="singlepost-gallery">';
	echo get_template_part('parts/single/media/blog-single-gallery');
	echo '</div>';
}

function dmn_oceanwp_metabox($types)
{

	// Your custom post type
	$types[] = 'event';

	// Return
	return $types;
}
// add_filter( 'ocean_main_metaboxes_post_types', 'dmn_oceanwp_metabox', 20 );
add_filter('ocean_gallery_metabox_post_types', 'dmn_oceanwp_metabox');


function my_post_layout_class($class)
{

	// Alter your layout
	if (is_singular('event')) {
		$class = 'full-width';
	}
	if (is_post_type_archive('event')) {
		$class = 'full-screen';
	}

	// Return correct class
	return $class;
}
add_filter('ocean_post_layout_class', 'my_post_layout_class', 20);

add_action('ocean_after_header', 'dmnDisplayPageTitle');
function dmnDisplayPageTitle()
{
	if (is_post_type_archive('event') || is_home()) {
?>

		<div class="tc-page-title">
			<div class="container">
				<div class="d-flex align-items-center justify-content-center">
					<!-- <div class="line-divider flex-fill"></div> -->
					<div class="pg-title">
						<?php if (is_post_type_archive('event')){
							echo '<h3 class="c-gold">PAST & UPCOMING</h3>';
							echo '<h2>EVENTS</h2>';
						}
						else {
							echo '<h3 class="c-gold">IN THE PRESS!</h3>';
							echo '<h2>NEWS</h2>';
						}
						?>
					</div>
					<!-- <div class="line-divider flex-fill"></div> -->
				</div>
			</div>
		</div>
	<?php
	}
}

add_shortcode('page_title', 'dmnTitleshorcode');
function dmnTitleshorcode()
{
	?>
	<div class="tc-page-title">
		<div class="container">
			<div class="d-flex align-items-center justify-content-center">
				<div class="line-divider flex-fill"></div>
				<div class="pg-title">
					<h2>
						<?php the_title(); ?>
					</h2>
				</div>
				<div class="line-divider flex-fill"></div>
			</div>
		</div>
	</div>
	<?php
}

add_shortcode('footercnt', 'dmnDisplayFooterContent');
function dmnDisplayFooterContent()
{
	// error_log($_COOKIE['darkmode']);
	echo get_template_part('parts/footer-cnt');
}
add_shortcode('footercol1', 'dmnDisplayFooterCol1');
function dmnDisplayFooterCol1()
{
	// error_log($_COOKIE['darkmode']);
	echo get_template_part('parts/footer-col1');
}

function dmn_single_meta()
{

	global $post;
	if ($post->post_type == "event") {
	?>
		<ul class="meta clr">
			<li class="meta-date" itemprop="datePublished"><span class="screen-reader-text">Post published:</span> <?php echo get_the_date(); ?></li>
		</ul>
<?php
	}
}
add_filter('ocean_after_single_post_title', 'dmn_single_meta');

// Team Members

add_action('wp_ajax_nopriv_member_show_post', 'member_show_post');
add_action('wp_ajax_member_show_post', 'member_show_post');
function member_show_post()
{
	check_ajax_referer('member-bootstrap', 'security');
	$id = $_GET['id'];
	$terms = get_the_terms($id, 'member_cat');
	$termid = $terms[0]->term_id;
	$termid = 'pop-cat-' . $termid;
	$post = get_post($id);
	$thumb = get_the_post_thumbnail($id, 'large');
	$memtitle = get_post_meta($id, 'memtitle', true);
	if ($post) {
		wp_send_json(array('post_title' => $post->post_title, 'post_content' => $post->post_content, 'post_thumbnail' => $thumb, 'memtitle' => $memtitle, 'cat_id' => $termid));
	} else {
		wp_send_json(array('error' => '1'));
	}
	wp_die();
}

function my_excerpt_length($length)
{
	$length = substr($length, 0, 170) . '...';
	return $length;
}
add_filter('oceanwp_excerpt', 'my_excerpt_length');


add_action('init', 'turncoin_add_theme_cookie');
function turncoin_add_theme_cookie(){
	// unset($_COOKIE["darkmode"]);
	if (!isset($_COOKIE["darkmode"])) {
		$ckval = "light";
		error_log('Cookie Set for first time');
		setcookie("darkmode", $ckval, time()+60*60*24*30, '/');
		error_log($_COOKIE["darkmode"]);
	}
	// foreach($_COOKIE as $key => $cookie){
	// 	error_log($key.' => '. $cookie);
	// }
}

add_filter( 'body_class', function( $classes ) {
	if(isset($_COOKIE["darkmode"])){
		$darkmodeclass = array($_COOKIE["darkmode"].'-mode');
	}
	else{
		// setcookie("darkmode", $ckval, time()+62208000, 'http://localhost:8888/turncoin.news/', $_SERVER['HTTP_HOST']);
		$darkmodeclass = array('light-mode');
	}
	error_log($darkmodeclass[0]);
    return array_merge( $classes, $darkmodeclass );
} );

add_action( 'ocean_after_nav', 'addDarkModeSwtich' );
function addDarkModeSwtich(){
	error_log($_COOKIE["darkmode"]);
	if ($_COOKIE["darkmode"] === "dark") {
		$checked = 'checked';
		error_log('checked');
	} else if($_COOKIE["darkmode"] === "light"){
		error_log('Not checked');
		$checked = '';
	}
	?>
	<div class="switch-cnt">
		<label class="switch">
                <input id="darkmode" type="checkbox" <?php echo $checked; ?>>
                <span class="slider round"></span><span class="switch-text">DARK MODE</span>
		</label>
		</div>
	<?php
}

add_action( 'wp_head', 'addheaderScripts' );
function addheaderScripts(){
	$ajax_nonce = wp_create_nonce("darkmode-check");
	echo '<script> var dms = "'.$ajax_nonce.'",';
	echo 'adurl = "'.admin_url('admin-ajax.php').'";';
	echo '</script>';
}

add_action('wp_ajax_nopriv_turncoin_set_thememode_cookie', 'turncoin_set_thememode_cookie');
add_action('wp_ajax_turncoin_set_thememode_cookie', 'turncoin_set_thememode_cookie');
function turncoin_set_thememode_cookie()
{
	// check_ajax_referer('darkmode-check', 'security');
	$mode = false;
	if(isset($_GET['settheme'])){
		$mode = true;
		$id = $_GET['settheme'];
		error_log($id);
		if ($id == "1") {
			$modeval = "light";
			error_log('lightmode is set');
			// error_log($_POST["settheme"] . '-true');
			setcookie("darkmode", $modeval,  time()+60*60*24*30, '/');
			error_log($_COOKIE["darkmode"]);
		} 
		if($id === "0"){
			$modeval = "dark";
			error_log('darkmode is set');
			// error_log($_POST["settheme"] . '-false');
			setcookie("darkmode", $modeval,  time()+60*60*24*30, '/');
			// $_COOKIE["darkmode"] = $modeval;
			error_log($_COOKIE["darkmode"]);
		}
	}
	wp_send_json(array('mode_set' => $mode));
}