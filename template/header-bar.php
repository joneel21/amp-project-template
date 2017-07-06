<?php 
	$general_option = get_option('ext_amp_general_options');
	
?>
<header id="#top" class="amp-wp-header">
	<div class="call-us">
			Call us: <span><a href="tel:1-<?php echo $general_option['phone-number'] ?>"><?php echo $general_option['phone-number'] ?></a></span>
	</div>	
	<div id="logo">		
		<a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>" title="<?php echo esc_html($this->get( 'blog_name' ) ); ?>"><amp-img width="186" height="53" src="<?php echo esc_url($general_option['site-logo']) ?>" alt="<?php echo esc_html( get_bloginfo('description') ); ?>" srcset="<?php echo esc_url($general_option['site-logo']) ?> 768w" sizes="(min-width: 768px) 186px, 130px"></amp-img></a>
	</div>
	<div class="nav">		
		<div class="socials">
			<div class="mk-header-social">
				<ul><li><a class="facebook-hover " target="_blank" href="<?php echo esc_url( $general_option['facebook'] ); ?>"><i class="fa fa-facebook"><span class="hide"></span></i></a></li><li><a class="googleplus-hover " target="_blank" href="<?php echo esc_url( $general_option['google-plus'] ); ?>"><i class="fa fa-google-plus"><span class="hide"></span></i></a></li><li><a class="twitter-hover " target="_blank" href="<?php echo esc_url( $general_option['twitter'] ); ?>"><i class="fa fa-twitter"><span class="hide"></span></i></a></li><li><a class="linkedin-hover " target="_blank" href="<?php echo esc_url( $general_option['linkedin'] ); ?>"><i class="fa fa-linkedin"><span class="hide"></span></i></a></li><li><a class="youtube-hover " target="_blank" href="<?php echo esc_url( $general_option['youtube'] ); ?>"><i class="fa fa-youtube-play"><span class="hide"></span></i></a></li><li><a class="instagram-hover " target="_blank" href="<?php echo esc_url( $general_option['instagram'] ); ?>"><i class="fa fa-instagram"><span class="hide">instagram</span></i></a></li></ul>
			</div>
		</div>
		<div class="menu-bar">
			<div id="st-trigger-effects"> 
				<button class="visible-tablet-icon" on="tap:AMP.setState({stMenuEffect: 'open'})"> MENU </button>
			</div>
		</div>
	</div>
</header>

<nav class="vertical-st-menu st-effect-1" id="menu-1">
	<ul>
		<?php if( has_nav_menu('primary-menu') ) { wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '') ); } ?>
		<li id="close-vertical-menu" class="close-st-menu" on="tap:AMP.setState({stMenuEffect: 'close'})"><i class="fa fa-times-circle-o" aria-hidden="true"></i></li>
	</ul> 
</nav>

