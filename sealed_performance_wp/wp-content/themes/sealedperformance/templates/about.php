<?php
/**
 * Template Name: About
 *
 */

get_header();

?>

<div class="container">

	<div class="content clearfix">

		<div class="column column--3-4">

			<?php the_content(); ?>

		</div>


		<div class="column column--1-4">

			<?php get_sidebar(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>