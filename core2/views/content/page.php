<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
 */
//test signal anchor
//echo "content/page";
?>
	<?php
	/**
	 * Functions hooked in to storefront_page add_action
	 *
	 * @hooked storefront_page_header          - 10
	 * @hooked storefront_page_content         - 20
	 */
//	do_action( 'storefront_page' );
	?>

        <?php the_content(); ?>