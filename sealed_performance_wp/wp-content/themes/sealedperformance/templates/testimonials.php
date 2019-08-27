<?php
/**
 * Template Name: Testimonials
 *
 */

get_header();

?>

<div class="container">

	<div class="content">

		<?php 

			$args = array(
				'post_type' => 'testimonials',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order'   => 'DESC'
			);

			$testimonial_query = new WP_Query($args);

		?>

		<?php if ( $testimonial_query->have_posts() ) : ?>

			<?php while( $testimonial_query->have_posts() ): $testimonial_query->the_post(); ?>

				<div class="testimonial">

					<?php the_content(); ?>
					<p><strong><?php the_field('customer_name'); ?></strong><br>
					<span class="color--red"><em><?php the_field('product'); ?></em><span></p>

				</div>
			    
			<?php endwhile; ?>

		<?php endif; ?>

	</div>

</div>







<?php get_footer(); ?>