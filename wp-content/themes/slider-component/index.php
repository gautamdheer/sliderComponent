<?php
/**
 * Fallback template.
 *
 * @package SliderComponent
 */

get_header();
?>
<main class="site-wrapper">
	<div class="site-content">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				the_content();
			}
		} else {
			esc_html_e( 'No content found.', 'slider-component' );
		}
		?>
	</div>
</main>
<?php
get_footer();

