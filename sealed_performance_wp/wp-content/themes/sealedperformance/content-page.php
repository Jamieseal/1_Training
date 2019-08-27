<?php
/**
 * The template used for displaying page content in page.php
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
					
	<h2 class="title"><?php echo get_the_title() ?></h2>
	<?php the_content(); ?>

</article><!-- #post -->
