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
add_filter( 'amp_post_template_file', 'ext_amp_custom_featured_image', 10, 3 );

function ext_amp_custom_featured_image( $file, $type, $post ) {
	if ( 'featured-image' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/featured-image.php';
	}
	return $file;
}
add_filter( 'amp_post_template_file', 'ext_amp_custom_meta_author', 10, 3 );

function ext_amp_custom_meta_author( $file, $type, $post ) {
	if ( 'meta-author' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/meta-author.php';
	}
	return $file;
}

add_filter( 'amp_post_template_file', 'ext_amp_custom_meta_time', 10, 3 );
function ext_amp_custom_meta_time( $file, $type, $post ) {
	if ( 'meta-time' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/meta-time.php';
	}
	return $file;
}

add_filter( 'amp_post_template_file', 'ext_amp_custom_footer', 10, 3 );

function ext_amp_custom_footer( $file, $type, $post ) {
	if ( 'footer' === $type ) {
		$file = EXT__AMP__DIR__ . '/template/footer.php';
	}
	return $file;
}