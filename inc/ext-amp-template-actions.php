<?php

add_filter( 'amp_post_template_data', 'custom_template_data', 10, 2 );

function custom_template_data($data){  
    
    $data['amp_component_scripts'] = array(        
        'amp-form' => 'https://cdn.ampproject.org/v0/amp-form-0.1.js',        
        'amp-iframe' => 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js',        
        'amp-bind' => 'https://cdn.ampproject.org/v0/amp-bind-0.1.js',
        'amp-social-share' => 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js'        
        );        

    $fontawesome = array(
        'fontawesome' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
    );

	$option = get_option('ext_amp_styling_options');

    $get_body_font = $option['body-font'];
    $get_header_font = $option['header-font'];
   
    if(!empty($get_body_font) || !empty($get_header_font)){        
        $google_font_url = 'https://fonts.googleapis.com/css?family='; 
        $get_body_font = !empty($get_body_font) && $get_body_font != '-1'? $get_body_font . '|' : ''; 
        $get_header_font = !empty($get_header_font) && $get_header_font != '-1'? $get_header_font . '|' : '';        
        $web_font = array( 'web-font' => $google_font_url . $get_body_font . $get_header_font);

        $data['font_urls'] = array_merge($web_font, $fontawesome);
    }
    else{
        $data['font_urls'] = $fontawesome;
    }
    

    return $data;
}

add_action( 'amp_post_template_css', 'ext_amp_my_additional_css_styles' );

function ext_amp_my_additional_css_styles( $amp_template ) {
	// only CSS here please...
    $ext_amp_css = get_option('ext_amp_styling_options');
    echo $ext_amp_css['extra-css'];
}

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

add_filter( 'amp_post_template_metadata', 'ext_amp_modify_json_metadata', 10, 2 );

function ext_amp_modify_json_metadata( $metadata, $post ) {
	//$metadata['@type'] = 'NewsArticle';

	$metadata['publisher']['logo'] = array(
		'@type' => 'ImageObject',
		'url' => plugins_url() . '/amp-project-template/asset/img/publisher-bluefox-logo-amp.png',
		'height' => 60,
		'width' => 600,
	);

	return $metadata;
}