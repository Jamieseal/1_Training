<?php
/**
 * Template Name: Contact
 *
 */

get_header();

?>

<div class="container">

	<div class="content clearfix">

		<section class="column column--3-4">

			<h2><?php the_title(); ?></h2>

			<?php the_content(); ?>

			<?php echo do_shortcode("[contact-form-7 id='127' title='Contact' ]"); ?>

		</section>

		<div class="column column--1-4">

			<?php get_sidebar(); ?>

		</div>

	</div>

</div>
<?php get_footer(); ?>