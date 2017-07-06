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
<script custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.1.js" async></script>

<style amp-custom>
   <?php    
   $this->load_parts(array('style'));
   do_action( 'amp_post_template_css', $this );    
   ?>
</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>" [class]="'st-effect-1 ' + menuEffect[stMenuEffect].class">
<amp-state id="menuEffect">
    <script type="application/json">
        {
            "open":{
                "class": "st-menu-open" 
            },
            "close":{
                "class": "st-menu-close"
            }

        }
    </script>
</amp-state>

<?php $this->load_parts( array( 'header-bar' ) ); ?>
<div class="main-content" role="" tabindex="-1" on="tap:AMP.setState({stMenuEffect: 'close'})">
    <div class="amp-blog-hero center-y" id="<?php echo get_the_ID();  ?>">
        <div class="content-holder">
            <h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
            <?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( 'meta-author', 'meta-time' ) ) ); ?>
        </div>	      
    </div>

    <article class="amp-wp-article">

        <div class="amp-wp-article-content amp-grid">

            <?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>

             <div class="amp-share-icon">
                <amp-social-share type="facebook" class="custom-style"
                    data-param-app_id="254325784911610"></amp-social-share>
                <amp-social-share type="twitter" class="custom-style"></amp-social-share>
            </div>

        </div>
        <div class="about-author-wrapper">
            <div class="about-author-meta" itemprop="author" itemscope="itemscope" itemtype="https://schema.org/Person">
                <div class="about-author-title">About</div>
                <a class="about-author-name" href="http://dev.meetbluefox.com/author/developer2/" itemprop="url"><span itemprop="name">Admin</span></a>
                <div class="about-author-desc"></div>
                <ul class="about-author-social"><li><a class="email-icon" title="Get in touch with me via email" target="_blank" href="mailto:wolfenstein22.2009@gmail.com"><i class="fa fa-envelope-o"><span class="hide"></span></i></a></li></ul>
            </div>
        </div>
        <footer class="amp-wp-article-footer">
            <?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', array( 'meta-taxonomy', 'meta-comments-link' ) ) ); ?>
        </footer>   

    </article>

    <?php $this->load_parts( array( 'footer' ) ); ?>

    <?php do_action( 'amp_post_template_footer', $this ); ?>
</div>
</body>

</html>