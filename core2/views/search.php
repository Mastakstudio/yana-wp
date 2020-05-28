<?php
get_header(); ?>

	<div>
		<main>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						/* translators: %s: search term */
						printf(  'Search Results for: %s', '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header>

			<?php
			get_template_part( 'loop' );

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
