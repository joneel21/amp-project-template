<!doctype html>
<html amp lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<?php
    //AMP meta data
    do_action( 'amp_post_template_head', $this );

    //custom style
    
?>
<style amp-custom>
   <?php    
   $this->load_parts(array('style'));
   do_action( 'amp_post_template_css', $this );    
   ?>
</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<article class="amp-wp-article">

	<header class="amp-wp-article-header">
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
		<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( 'meta-author', 'meta-time' ) ) ); ?>
        
	</header>
   
    <?php if( has_nav_menu('primary-menu') ) { wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '') ); } ?>
    
    <?php mk_get_header_view('global', 'social', ['location' => 'header']); ?>

	<?php $this->load_parts( array( 'featured-image' ) ); ?>

	<div class="amp-wp-article-content">
		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
	</div>

	<footer class="amp-wp-article-footer">
		<?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', array( 'meta-taxonomy', 'meta-comments-link' ) ) ); ?>
	</footer>   

    <?php if ( is_active_sidebar( 'amp-first-widget' ) ) : ?>
        <div id="secondary" class="widget-area" role="complementary">
            <p>Test</p>
            <?php dynamic_sidebar( 'amp-first-widget' ); ?>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'amp-second-widget' ) ) : ?>
        <div id="secondary" class="widget-area" role="complementary">
            <p>Test</p>
            <?php dynamic_sidebar( 'amp-second-widget' ); ?>
        </div>
    <?php endif; ?>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>

</html>