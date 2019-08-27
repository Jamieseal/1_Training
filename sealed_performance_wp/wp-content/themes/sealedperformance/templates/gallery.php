<?php
/**
 * Template Name: Gallery
 *
 */

get_header();

?>

<div class="container">

	<div class="content clearfix">

		<?php 

			$args = array(
				'post_type' => 'gallery',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order'   => 'DESC'
			);

			$gallery_query = new WP_Query($args);

		?>

		<?php if ( $gallery_query->have_posts() ) : ?>

			<div class="gallery" data-featherlight-gallery data-featherlight-filter="a">

				<?php while( $gallery_query->have_posts() ): $gallery_query->the_post(); ?>

					<div class="column column--1-5">

						<?php 

							$image = get_field('image');
							$image_url = $image['url'];
							$image_height = $image['height'];
							$image_width = $image['width'];
							$image_alt = $image['alt'];
							$image = $image['sizes']['gallery'];

						 ?>

						<a href="<?php echo $image_url; ?>">
								<img class="u-image-block" src="<?php echo $image ?>" width="<?php echo $image_width ?>" height="<?php echo $image_height ?>" alt="<?php echo $image_alt ?>" />
						</a>

					</div>
				    
				<?php endwhile; ?>

			</div>

		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>