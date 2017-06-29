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

    <amp-iframe width="500"
    height="200"
    layout="responsive"
    sandbox="allow-scripts allow-same-origin allow-popups"
    frameborder="0"
    src="https://www.google.com/maps/embed/v1/place?q=10000+N+31st+Ave+d411,+Phoenix,+AZ+85051,+USA&key=AIzaSyCNCZ0Twm_HFRaZ5i-FuPDYs3rLwm4_848">
    </amp-iframe>

    <?php if ( is_active_sidebar( 'amp-first-widget' ) ) : ?>
        <div id="col1" class="widget-area" role="complementary">            
            <?php dynamic_sidebar( 'amp-first-widget' ); ?>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'amp-second-widget' ) ) : ?>
        <div id="col2" class="widget-area" role="complementary">            
            <?php dynamic_sidebar( 'amp-second-widget' ); ?>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'amp-third-widget' ) ) : ?>
        <div id="col3" class="widget-area" role="complementary">            
            <?php dynamic_sidebar( 'amp-third-widget' ); ?>
        </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'sidebar-13' ) ) : ?>
        <div id="col4" class="widget-area" role="complementary">            
            <?php dynamic_sidebar( 'sidebar-13' ); ?>
        </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'sidebar-14' ) ) : ?>
        <div id="col5" class="widget-area" role="complementary">            
            <?php dynamic_sidebar( 'sidebar-14' ); ?>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'sidebar-15' ) ) : ?>
        <div id="col6" class="widget-area" role="complementary">            
            <?php dynamic_sidebar( 'sidebar-15' ); ?>
        </div>
    <?php endif; ?>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>

</html>