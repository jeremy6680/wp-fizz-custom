<?php
/**
 * Default template for movie reviews
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="content site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); ?>

        <h2>BONJOUR</h2>

		<?php	
        // End the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer();