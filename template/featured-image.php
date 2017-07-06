<?php
$post_id = get_the_ID();
$featured_image = get_the_post_thumbnail( $post_id, 'full' );
$featured_image = preg_replace('/img/', 'amp-img layout="responsive" id="'.$post_id.'"', $featured_image) . '</amp-img>';

if ( empty( $featured_image ) ) {
	return;
}

?>
<figure class="amp-wp-article-featured-image wp-caption">

</figure>


