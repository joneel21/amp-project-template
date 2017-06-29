<?php
//Filter Default Template File Location
add_filter( 'amp_post_template_file', 'ext_amp_set_custom_template', 10, 3 );

function ext_amp_set_custom_template( $file, $type, $post ) {
	if ( 'single' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/single.php';
	}
	return $file;
}
add_filter( 'amp_post_template_file', 'ext_amp_custom_style', 10, 3 );

function ext_amp_custom_style( $file, $type, $post ) {
	if ( 'style' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/style.php';
	}
	return $file;
}
add_filter( 'amp_post_template_file', 'ext_amp_custom_header', 10, 3 );

function ext_amp_custom_header( $file, $type, $post ) {
	if ( 'header-bar' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/header-bar.php';
	}
	return $file;
}