<?php
/**
 * Plugin Name: Rest Api Meta for The SEO Framework
 * Plugin URI: https://diffusionedigitale.it/
 * Description: Export The Seo Framework to Rest Api meta endpoint
 * Version: 4.0.2
 * Author: massimomarazzi
 * Author URI: https://diffusionedigitale.it/
 * License: GPLv3
 * Text Domain: ramtsf
 *
 * @copyright  2019 Diffusione Digitale di Massimo Marazzi
 * @license uri: http://www.gnu.org/licenses/gpl-3.0.txt
 */


add_action('plugins_loaded', function(){
	
	if( defined('THE_SEO_FRAMEWORK_VERSION') ){
		add_action('init', 'ramtsf_init',  PHP_INT_MAX );
	}
});


function ramtsf_init(){
	foreach ( ramtsf_post_meta() as $meta_key => $register_meta_options ){
		register_meta('post', $meta_key,
			[
				'object_subtype' => '',
				'single' => true,
				'sanitize_callback' => $register_meta_options['cb'],
				'show_in_rest' => true,
				'type' => $register_meta_options['type'],
				'description' => 'The Seo Framework Fields',
				'auth_callback' => function(){
					return current_user_can( 'edit_pages' );
				}
			]
		);
	}
}

function ramtsf_post_meta() {
	return [
		'_genesis_title'          => ['cb' => 'sanitize_text_field', 'type' => 'string'],
		'_tsf_title_no_blogname'  => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'_genesis_description'    => ['cb' => 'sanitize_text_field', 'type' => 'string'],
		'_genesis_canonical_uri'  => ['cb' => 'ramtsf_esc_url', 'type' => 'string'],
		'redirect'                => ['cb' => 'ramtsf_esc_url', 'type' => 'string'],
		'_social_image_url'       => ['cb' => 'ramtsf_esc_url', 'type' => 'string'],
		'_social_image_id'        => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'_genesis_noindex'        => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'_genesis_nofollow'       => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'_genesis_noarchive'      => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'exclude_local_search'    => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'exclude_from_archive'    => ['cb' => 'ramtsf_bool', 'type' => 'boolean'],
		'_open_graph_title'       => ['cb' => 'sanitize_text_field', 'type' => 'string'],
		'_open_graph_description' => ['cb' => 'sanitize_textarea_field', 'type' => 'string'],
		'_twitter_title'          => ['cb' => 'sanitize_text_field', 'type' => 'string'],
		'_twitter_description'    => ['cb' => 'sanitize_textarea_field', 'type' => 'string'],
	];
}

function ramtsf_bool( $value ){
	if( $value ){
		return 1;
	}
	return 0;
}

function ramtsf_esc_url( $value ){
	
	if( ! empty($value)){
		return esc_url($value);
	}
	return '';
}