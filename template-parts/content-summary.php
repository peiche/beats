<?php
/**
 * The template used for displaying page content in The Loop
 *
 * @package Cover
 */

?>

<?php
if ( '' != get_the_post_thumbnail() ) {
	$img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$img = $img_arr[0];
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( is_sticky() && '' != get_the_post_thumbnail() ) { ?>
        <div class="cover-background darken" style="background-image: url('<?php echo $img; ?>');"></div>
    <?php } ?>

		<?php if ( ! is_sticky() && '' != get_the_post_thumbnail() && 1 == esc_attr( get_theme_mod( 'cover_show_featured_image', 0 ) ) ) { ?>
			<div class="entry-featured-image" style="background-image: url('<?php echo $img; ?>');">
				<a href="<?php the_permalink(); ?>"></a>
			</div>
		<?php } ?>

    <header class="entry-header">
			<?php
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( __( ', ', 'cover' ) );
        if ( $categories_list && cover_categorized_blog() ) :
      ?>
        <h2 class="entry-subtitle"><?php echo $categories_list; ?></h2>
      <?php endif; ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
      <div class="entry-meta">
        <?php cover_posted_on(); ?>
      </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php
            if ( has_excerpt() ) {
              the_excerpt();
            } else if ( strpos( $post->post_content, '<!--more-->' ) ) {
              the_content( '' ); // No "more" link.
            } else {
							the_excerpt();
						}
        ?>

        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'cover' ),
                'after'  => '</div>',
								'link_before' => '<span class="button small">',
								'link_after'  => '</span>',
            ) );
        ?>
    </div><!-- .entry-summary -->
</article><!-- #post-## -->
