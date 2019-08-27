<?php
/**
 * Template Name: Home
 *
 */

get_header();

?>

<div class="container">

	<div class="content">

		<section>

			<h2>About Sealed Performance</h2>

			<? $the_query = new WP_Query( 'page_id=30' );
				while ( $the_query->have_posts() ) : $the_query->the_post();
				        the_excerpt();
				endwhile;
			wp_reset_postdata(); ?>

		</section>

	</div>

</div>

<?php get_footer(); ?>