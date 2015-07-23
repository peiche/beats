<?php
/**
 * Cover Theme Customizer
 *
 * @package Cover
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cover_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

  $wp_customize->add_setting(
    'cover_header_color',
    array(
      'default'           => '#026ed2',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_setting(
    'cover_link_color',
    array(
      'default'           => '#026ed2',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
	$wp_customize->add_setting(
		'cover_overlay_color',
		array(
			'default' => 'overlay-dark',
		)
	);

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'cover_header_color',
      array(
        'label'      => __( 'Header Color', 'cover' ),
        'section'    => 'colors',
        'settings'   => 'cover_header_color',
      )
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'cover_link_color',
      array(
        'label'      => __( 'Link Color', 'cover' ),
        'section'    => 'colors',
        'settings'   => 'cover_link_color',
      )
    )
  );
	$wp_customize->add_control(
		'cover_overlay_color',
		array(
			'type'    => 'select',
			'label'   => 'Overlay Color',
			'section' => 'colors',
			'choices' => array(
				'overlay-dark'  => 'Dark',
				'overlay-light' => 'Light',
			),
		)
	);
}
add_action( 'customize_register', 'cover_customize_register' );

/**
 * Output custom css based on header and link colors.
 */
function cover_customize_options() {
  $header_color = get_theme_mod( 'cover_header_color', '#026ed2' );
  $link_color = get_theme_mod( 'cover_link_color', '#026ed2' );
	$overlay_color = get_theme_mod( 'cover_overlay_color', 'overlay-dark' );
  ?>

<style>
<?php // Set accent color. ?>
a,a:visited,.entry-title a:hover,.entry-subtitle a:hover { color: <?php echo $link_color; ?>; }
a:hover { color: <?php echo darken( $link_color, 15 ); ?>; }
.header .backdrop, .cover { background-color: <?php echo $header_color; ?>; }
.paging-navigation a, ul.categories a, body #infinite-handle span, .button.default { background-color: <?php echo $link_color; ?>; }
.paging-navigation a:hover, body #infinite-handle span:hover, .button.default:hover { background-color: <?php echo darken( $link_color, 15 ); ?>; }
body .infinite-loader .spinner { border-top-color: <?php echo $link_color; ?>; }
.fotorama__thumb-border { border-color: <?php echo $link_color; ?>; }
blockquote, q, .aesop-component.aesop-quote-component.aesop-quote-type-pull.aesop-component-align-left, .aesop-component.aesop-quote-component.aesop-quote-type-pull.aesop-component-align-right, .aesop-component.aesop-quote-component.aesop-quote-type-pull.aesop-component-align-center { border-color: <?php echo $header_color; ?> }

<?php // Restore default colors. ?>
.header a, <?php if ( 'overlay-dark' == $overlay_color ) { ?>.overlay a, <?php } ?>.cover-header a { color: #fff; }
.cover-subtitle a { color: rgba(255, 255, 255, 0.8); }
.entry-title a { color: #222; }
.entry-subtitle a { color: #999; }

<?php if ( 'overlay-light' == $overlay_color ) { ?>
.noscroll .hamburger span:before,
.noscroll .hamburger span:after,
.hamburger.close span:before,
.hamburger.close span:after {
  background-color: #000 !important;
}
<?php } ?>

</style>

<meta name="theme-color" content="<?php echo $header_color; ?>">

<?php
}
add_action( 'wp_head', 'cover_customize_options' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cover_customize_preview_js() {
	wp_enqueue_script( 'cover_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'cover_customize_preview_js' );
