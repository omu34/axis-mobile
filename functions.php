<?php

/**
 * Axis-2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Axis-mobile
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function axis_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Axis-2, use a find and replace
		* to change 'axis' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('axis', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'axis'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'axis_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'axis_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function axis_content_width()
{
	$GLOBALS['content_width'] = apply_filters('axis_content_width', 640);
}
add_action('after_setup_theme', 'axis_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function axis_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'axis'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'axis'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'axis_widgets_init');





// Create a custom function to process the form submission
function process_form_submission()
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$name = sanitize_text_field($_POST['name']);
		$email = sanitize_email($_POST['email']);
		$phone = sanitize_text_field($_POST['phone']);
		$message = sanitize_text_field($_POST['message']);


		$post_data = array(
			'post_title' => $name,
			'post_content' => $message,
			'post_status' => 'publish',
			'post_type' => 'thank-you', // Replace with your custom post type
		);

		$post_id = wp_insert_post($post_data);

		if ($post_id) {

			wp_redirect('/thank-you'); // Replace with your thank you page URL
			exit;
		} else {
			// Form submission failed
			// Handle the error, e.g., display an error message
		}
	}
}

add_action('init', 'process_form_submission');





/**
 * Enqueue scripts and styles.
 */
function axis_scripts()
{
	wp_enqueue_style('axis-style', get_template_directory_uri() . "/assets/css/output.css", array('axis-tailwind'), _S_VERSION);
	wp_enqueue_style('axis-styles', get_template_directory_uri() . "/assets/css/styles.css", array(), "all");
	wp_enqueue_style('axis-circular', get_template_directory_uri() . "/assets/css/circular.css", array(), "all");
	wp_enqueue_style('axis-lands', get_template_directory_uri() . "/assets/css/lands.css", array(), "all");

	wp_style_add_data('axis-style', 'rtl', 'replace');
	
	wp_enqueue_style('axis-tailwind', "https://cdn.jsdelivr.net/npm/tailwindcss/assets/css/tailwind.min.css", array(), "all");
	wp_enqueue_style('axis-unbounded', "https://fonts.googleapis.com/css2?family=Unbounded:wght@200;300;467;700;900&display=swap", array(), "all");
	wp_enqueue_style('axis-flow-bite', "https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css", array(), "1.8.0", "all");
	wp_enqueue_style('axis-fontAwesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css", array(), "4.17.0", "all");
	wp_enqueue_style('axis-font-Awesome', "	https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css", array(), "6.1.0", "all");
	wp_enqueue_style('axis-animate', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css", array(), "4.1.1", "all");
	
	wp_enqueue_script('axis-button', get_template_directory_uri() . '/assets/css/js/button.js', array(), true);
	wp_enqueue_script('axis-navigation', get_template_directory_uri() . '/js/navigation.js', array(), true);
	wp_enqueue_script('axis-taos', get_template_directory_uri() . '/assets/css/js/taos.js', array(), "2.3.4", true);
	wp_enqueue_script('axis-scroll-top', get_template_directory_uri() . '/assets/css/js/scroll-top.js', array(), "2.3.4", true);
	wp_enqueue_script('axis-landing', get_template_directory_uri() . '/assets/css/js/lands.js', array(), "2.3.4", true);

	wp_enqueue_script('axis-carousels', "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js", array(), "2.3.4", true);
	
	wp_enqueue_script('axis-flow-bite', "https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js", array(), "1.8.0", true);
	wp_enqueue_script('axis-flow-bites', "https://unpkg.com/flowbite@1.4.0/dist/flowbite.js", array(), "1.4.0", true);

	wp_enqueue_script('axis-alpine2', "https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js", array(), "2.8.2", true);
	wp_enqueue_script('axis-alpine', "https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js", array(), "1.8.0", true);
	wp_enqueue_script('axis-alpine1', "https://unpkg.com/alpinejs", array(), "1.4.0", true);



	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'axis_scripts');







/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
