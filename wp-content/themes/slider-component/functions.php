<?php
/**
 * Theme bootstrap.
 *
 * @package SliderComponent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SLIDER_COMPONENT_VERSION', '1.0.0' );

/**
 * Theme supports & scripts.
 */
function slider_component_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'slider_component_setup' );

/**
 * Enqueue front-end assets.
 */
function slider_component_enqueue_assets() {
	wp_enqueue_style(
		'slider-component-style',
		get_stylesheet_uri(),
		[],
		SLIDER_COMPONENT_VERSION
	);

	wp_enqueue_style(
		'slider-component-slider',
		get_template_directory_uri() . '/assets/css/slider.css',
		[],
		SLIDER_COMPONENT_VERSION
	);

	wp_enqueue_script(
		'slider-component-slider',
		get_template_directory_uri() . '/assets/js/slider.js',
		[],
		SLIDER_COMPONENT_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'slider_component_enqueue_assets' );

/**
 * ACF local field group registration.
 */
function slider_component_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		[
			'key'      => 'group_slider_component',
			'title'    => __( 'Slider Component', 'slider-component' ),
			'fields'   => [
				[
					'key'           => 'field_slider_title',
					'label'         => __( 'Title', 'slider-component' ),
					'name'          => 'slider_title',
					'type'          => 'text',
					'instructions'  => '',
					'required'      => 1,
					'default_value' => __( 'Discover Our Highlights', 'slider-component' ),
					'placeholder'   => __( 'Slider title', 'slider-component' ),
				],
				[
					'key'           => 'field_slider_background',
					'label'         => __( 'Background Color', 'slider-component' ),
					'name'          => 'slider_background',
					'type'          => 'select',
					'required'      => 1,
					'choices'       => [
						'white'   => __( 'White', 'slider-component' ),
						'black'   => __( 'Black', 'slider-component' ),
						'#ebebeb' => __( '#EBEBEB', 'slider-component' ),
						'#b02543' => __( '#B02543', 'slider-component' ),
					],
					'default_value' => 'white',
				],
				[
					'key'          => 'field_slider_content',
					'label'        => __( 'Content', 'slider-component' ),
					'name'         => 'slider_content',
					'type'         => 'wysiwyg',
					'required'     => 0,
					'tabs'         => 'all',
					'toolbar'      => 'full',
					'media_upload' => 1,
					'default_value'=> '<p>' . __( 'Use this slider to showcase featured content, promotions, or announcements.', 'slider-component' ) . '</p>',
				],
				[
					'key'          => 'field_slider_image_1',
					'label'        => __( 'Image 1', 'slider-component' ),
					'name'         => 'slider_image_1',
					'type'         => 'image',
					'required'     => 0,
					'return_format'=> 'array',
					'preview_size' => 'medium',
					'library'      => 'all',
				],
				[
					'key'          => 'field_slider_caption_1',
					'label'        => __( 'Caption 1', 'slider-component' ),
					'name'         => 'slider_caption_1',
					'type'         => 'text',
					'required'     => 0,
				],
				[
					'key'          => 'field_slider_image_2',
					'label'        => __( 'Image 2', 'slider-component' ),
					'name'         => 'slider_image_2',
					'type'         => 'image',
					'required'     => 0,
					'return_format'=> 'array',
					'preview_size' => 'medium',
					'library'      => 'all',
				],
				[
					'key'          => 'field_slider_caption_2',
					'label'        => __( 'Caption 2', 'slider-component' ),
					'name'         => 'slider_caption_2',
					'type'         => 'text',
					'required'     => 0,
				],
				[
					'key'          => 'field_slider_image_3',
					'label'        => __( 'Image 3', 'slider-component' ),
					'name'         => 'slider_image_3',
					'type'         => 'image',
					'required'     => 0,
					'return_format'=> 'array',
					'preview_size' => 'medium',
					'library'      => 'all',
				],
				[
					'key'          => 'field_slider_caption_3',
					'label'        => __( 'Caption 3', 'slider-component' ),
					'name'         => 'slider_caption_3',
					'type'         => 'text',
					'required'     => 0,
				],
			],
			'location' => [
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					],
				],
			],
		]
	);
}
add_action( 'acf/init', 'slider_component_register_acf_fields' );

/**
 * Create sample page with slider template on theme activation.
 */
function slider_component_create_sample_page() {
	if ( ! function_exists( 'wp_insert_post' ) ) {
		return;
	}

	$page_title = __( 'Slider Sample', 'slider-component' );
	$existing   = get_page_by_path( 'slider-sample', OBJECT, 'page' );

	if ( $existing ) {
		return;
	}

	$page_id = wp_insert_post(
		[
			'post_title'   => $page_title,
			'post_name'    => 'slider-sample',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		]
	);

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_post_meta( $page_id, '_wp_page_template', 'page-slider.php' );
	}
}
add_action( 'after_switch_theme', 'slider_component_create_sample_page' );

