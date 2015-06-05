<?php
/**
 * Cover functions and definitions
 *
 * @package Cover
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1600; // Actual content width is 760, but I prefer to unrestrict images from having a small width.
}

if ( ! function_exists( 'cover_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cover_setup() {

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cover, use a find and replace
	 * to change 'cover' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cover', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in multiple locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cover' ),
	) );
    register_nav_menus( array(
		'social_header' => __( 'Social Menu (Overlay)', 'cover' ),
	) );
    register_nav_menus( array(
		'social_footer' => __( 'Social Menu (Footer)', 'cover' ),
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );

    // WordPress 4.1 and above.
    add_theme_support( 'title-tag' );

}
endif;
add_action( 'after_setup_theme', 'cover_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function cover_widgets_init() {

    register_sidebar( array(
		'name'          => __( 'Overlay Widgets', 'cover' ),
		'id'            => 'cover-overlay',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'cover_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cover_scripts() {

    wp_enqueue_style( 'GoogleFonts', '//fonts.googleapis.com/css?family=Source+Code+Pro|Montserrat|Open+Sans:400,600' );
	wp_enqueue_style( 'cover-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cover-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );
	wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array(), '20140821', true );
    wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', array(), '20140814', true );
	wp_enqueue_script( 'cover-lib', get_template_directory_uri() . '/js/cover.min.js', array(), '20140210', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cover_scripts' );

/**
 * Color contrast calculation. Compares to value halfway between black and white.
 *
 * @link http://24ways.org/2010/calculating-color-contrast/
 * @param string $hexcolor The hexidecimal value of the color.
 */
function get_contrast_50( $hexcolor ) {
    return ( hexdec( $hexcolor ) > 0xffffff / 2 ) ? 'light' : 'dark';
}

/**
 * Color contrast calculation. Converts RGB color space into YIQ.
 *
 * @link http://24ways.org/2010/calculating-color-contrast/
 * @param string $hexcolor The hexidecimal value of the color.
 */
function get_contrast_yiq( $hexcolor ) {
	$r = hexdec( substr( $hexcolor, 0, 2 ) );
	$g = hexdec( substr( $hexcolor, 2, 2 ) );
	$b = hexdec( substr( $hexcolor, 4, 2 ) );
	$yiq = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;

    return ( $yiq >= 128 ) ? 'light' : 'dark';
}

/**
 * The real contrast function. Call this one and leave the function that you want uncommented.
 *
 * @param string $hexcolor The hexidecimal value of the color.
 */
function get_contrast( $hexcolor ) {
    return
        get_contrast_50( $hexcolor )
        /* get_contrast_yiq( $hexcolor ) */
        ;
}

/**
 * Utility function to convert a hexidecimal color to rgb.
 *
 * @link http://css-tricks.com/snippets/php/convert-hex-to-rgb/
 * @param string $color The hexidecimal value of the color.
 */
function hex_to_rgb( $color ) {
        if ( '#' == $color[0] ) {
                $color = substr( $color, 1 );
        }
        if ( strlen( $color ) == 6 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * PHP equivalent to Sass function darken().
 *
 * @link https://gist.github.com/jegtnes/5720178
 * @param string $hex The hexidecimal value of the color.
 * @param string $percent The percentage to darken the color.
 */
function sass_darken($hex, $percent) {
    preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors );
	str_replace( '%', '', $percent );
	$color = '#';
	for ( $i = 1; $i <= 3; $i++ ) {
		$primary_colors[ $i ] = hexdec( $primary_colors[ $i ] );
		$primary_colors[ $i ] = round( $primary_colors[ $i ] * ( 100 - ( $percent * 2 ) ) / 100 );
		$color .= str_pad( dechex( $primary_colors[ $i ] ), 2, '0', STR_PAD_LEFT );
	}

	return $color;
}

/**
 * PHP equivalent to Sass function lighten().
 *
 * @link https://gist.github.com/jegtnes/5720178
 * @param string $hex The hexidecimal value of the color.
 * @param string $percent The percentage to lighten the color.
 */
function sass_lighten($hex, $percent) {
	preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors );
	str_replace( '%', '', $percent );
	$color = '#';
	for ( $i = 1; $i <= 3; $i++ ) {
		$primary_colors[ $i ] = hexdec( $primary_colors[ $i ] );
		$primary_colors[ $i ] = round( $primary_colors[ $i ] * ( 100 + ( $percent * 2 ) ) / 100 );
		$color .= str_pad( dechex( $primary_colors[ $i ] ), 2, '0', STR_PAD_LEFT );
	}

	return $color;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Aesop Story Engine compatibility.
 */
require get_template_directory() . '/inc/aesop.php';

/**
 * Load Color Posts compatibility.
 */
require get_template_directory() . '/inc/color-posts.php';

/**
 * Load TGM Plugin Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgm-plugin-activation.php';
