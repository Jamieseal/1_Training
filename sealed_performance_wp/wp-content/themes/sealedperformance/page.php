<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header();

?>

<main class="content" role="main">

	<?php while ( have_posts() ): the_post(); ?>

		<?php if ( get_field('banner_image') ): ?>
			<div class="row">
				<img
					class="u-image-block" 
					src="<?php the_image_field( 'banner_image' ); ?>"
					alt="<?php the_image_field( 'banner_image', 'alt' ); ?>" 
					width="<?php the_image_field( 'banner_image', 'width' ); ?>" 
					height="<?php the_image_field( 'banner_image', 'height' ); ?>"
				>
			</div>
		<?php endif ?>

		<div class="container">
			<?php get_template_part('content', 'page') ?>
		</div>
		
	<?php endwhile; ?>

</main>
			
<?php get_footer(); ?>
