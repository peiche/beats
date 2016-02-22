<?php
/**
 * Header for posts and pages
 *
 * @package Cover
 */

?>

<?php
    $class = '';
    $height = 0;

    if ( '' != get_the_post_thumbnail() ) {
        $img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $img = $img_arr[0];
        $width = $img_arr[1];
        $height = $img_arr[2];
        $class = ' featured-image';
        if ( $height > 1 && $height <= 600 ) {
          $class = $class . ' hero';
        } else if ( $height > 600 ) {
			    $class = $class . ' full';
		    }
    }
?>

<div class="cover<?php echo $class; ?>">
  <div class="cover-background<?php if ( '' != $class ) { ?>" style="background-image: url('<?php echo $img; ?>');<?php } ?>" role="img"></div>

    <header class="cover-header">
      <?php
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( __( ', ', 'cover' ) );
        if ( $categories_list && cover_categorized_blog() ) :
      ?>
        <h2 class="cover-subtitle"><?php echo $categories_list; ?></h2>
      <?php endif; ?>

      <h1 class="cover-title"><?php the_title(); ?></h1>

      <?php if ( 'thread' != get_post_type() ) { ?>
        <div class="entry-meta">
          <?php cover_posted_on(); ?>
        </div>
      <?php } ?>

    </header>

    <?php if ( $height > 600 ) { ?>
      <a href="#post-<?php the_ID(); ?>" class="cover-background-jump"><i class="fa fa-fw fa-angle-down"></i></a>
      <a href="<?php echo $img; ?>" class="cover-background-link swipebox" target="_blank"><i class="fa fa-fw fa-expand"></i></a>
    <?php } ?>

</div>
