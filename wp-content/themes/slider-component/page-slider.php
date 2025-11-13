<?php
/**
 * Template Name: Slider Page
 *
 * Displays the slider component populated via ACF fields.
 *
 * @package SliderComponent
 */

get_header();

if ( ! function_exists( 'get_field' ) ) {
	echo '<main class="site-wrapper"><div class="site-content">';
	esc_html_e( 'Advanced Custom Fields plugin is required to render this slider.', 'slider-component' );
	echo '</div></main>';
	get_footer();
	return;
}

$title      = get_field( 'slider_title' );
$background = get_field( 'slider_background' ) ?: 'white';
$content    = get_field( 'slider_content' );

$raw_slides = [
	[
		'image'   => get_field( 'slider_image_1' ),
		'caption' => get_field( 'slider_caption_1' ),
	],
	[
		'image'   => get_field( 'slider_image_2' ),
		'caption' => get_field( 'slider_caption_2' ),
	],
	[
		'image'   => get_field( 'slider_image_3' ),
		'caption' => get_field( 'slider_caption_3' ),
	],
];

$slides = array_values(
	array_filter(
		$raw_slides,
		static function ( $slide ) {
			return ! empty( $slide['image'] ) || ! empty( $slide['caption'] );
		}
	)
);

if ( empty( $slides ) ) {
	$slides = [
		[
			'image'   => [
				'url' => get_template_directory_uri() . '/assets/images/slide-1.svg',
				'alt' => __( 'Sample slide 1', 'slider-component' ),
			],
			'caption' => __( 'Sample caption for slide one.', 'slider-component' ),
		],
		[
			'image'   => [
				'url' => get_template_directory_uri() . '/assets/images/slide-2.svg',
				'alt' => __( 'Sample slide 2', 'slider-component' ),
			],
			'caption' => __( 'Sample caption for slide two.', 'slider-component' ),
		],
		[
			'image'   => [
				'url' => get_template_directory_uri() . '/assets/images/slide-3.svg',
				'alt' => __( 'Sample slide 3', 'slider-component' ),
			],
			'caption' => __( 'Sample caption for slide three.', 'slider-component' ),
		],
	];
}

$has_multiple     = count( $slides ) > 1;
$is_dark          = in_array( $background, [ 'black', '#b02543' ], true );
$text_color       = $is_dark ? '#ffffff' : '#111111';
$dot_color        = $is_dark ? 'rgba(255, 255, 255, 0.7)' : 'rgba(17, 17, 17, 0.3)';
$background_value = $background;
?>

<main class="site-wrapper">
	<div class="site-content">
		<?php if ( $title || $content || $slides ) : ?>
			<section
				class="slider-component"
				style="--slider-bg: <?php echo esc_attr( $background_value ); ?>; --slider-color: <?php echo esc_attr( $text_color ); ?>; --slider-dot: <?php echo esc_attr( $dot_color ); ?>;"
				data-has-dots="<?php echo $has_multiple ? 'true' : 'false'; ?>"
			>
				<div class="slider-component__layout">
					<div class="slider-component__content">
						<?php if ( $title ) : ?>
							<h1 class="slider-component__title"><?php echo esc_html( $title ); ?></h1>
						<?php endif; ?>
						<?php if ( $content ) : ?>
							<div class="slider-component__text">
								<?php echo wp_kses_post( $content ); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $slides ) ) : ?>
						<div class="slider-component__media" data-slider tabindex="0">
							<div class="slider-component__slides" data-slider-track>
								<?php foreach ( $slides as $index => $slide ) :
									$image   = $slide['image'] ?? null;
									$caption = $slide['caption'] ?? '';
									$image_url = $image['sizes']['large'] ?? $image['url'] ?? '';
									$alt_attr  = $image['alt'] ?? '';
									?>
									<figure class="slider-component__slide" data-slider-index="<?php echo esc_attr( $index ); ?>">
										<?php if ( $image_url ) : ?>
											<img
												src="<?php echo esc_url( $image_url ); ?>"
												alt="<?php echo esc_attr( $alt_attr ); ?>"
												loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
											/>
										<?php endif; ?>
										<?php if ( $caption ) : ?>
											<figcaption><?php echo esc_html( $caption ); ?></figcaption>
										<?php endif; ?>
									</figure>
								<?php endforeach; ?>
							</div>
							<?php if ( $has_multiple ) : ?>
								<div class="slider-component__dots" data-slider-dots>
									<?php foreach ( $slides as $index => $slide ) : ?>
										<button
											type="button"
											class="slider-component__dot<?php echo 0 === $index ? ' is-active' : ''; ?>"
											data-slider-target="<?php echo esc_attr( $index ); ?>"
											aria-label="<?php printf( esc_attr__( 'Slide %d', 'slider-component' ), $index + 1 ); ?>"
										></button>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		<?php else : ?>
			<p><?php esc_html_e( 'Please add content to the slider fields.', 'slider-component' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();

