
<div class="footer-container">

<footer id="amp-footer-top">
	<div class="footer-wrapper amp-grid">				
		<div class="amp-col-1-3">
			<div class="col-widget col-widget-1">
			<?php if ( is_active_sidebar( 'amp-first-widget' ) ) : ?>
						
				<?php dynamic_sidebar( 'amp-first-widget' ); ?>
			
			<?php endif; ?>
			</div>
		</div>
		<div class="amp-col-1-3">
			<div class="col-widget col-widget-2">
			<?php if ( is_active_sidebar( 'amp-second-widget' ) ) : ?>
							
				<?php dynamic_sidebar( 'amp-second-widget' ); ?>
			<?php else: echo '<div class="widget-title">Nothing to show right now!</div>'; ?>	
			<?php endif; ?>
			</div>
		</div>
		<div class="amp-col-1-3">
			<div class="col-widget col-widget-3">
			<?php if ( is_active_sidebar( 'amp-third-widget' ) ) : ?>
							
				<?php dynamic_sidebar( 'amp-third-widget' ); ?>
			
			<?php endif; ?>
			</div>
		</div>				
	</div>	
</footer>

<footer class="" id="amp-footer">
	<div class="footer-wrapper amp-grid">		
		<div class="amp-col-1-3">			
			<?php if ( is_active_sidebar( 'sidebar-13' ) ) : ?>
				        
				<?php dynamic_sidebar( 'sidebar-13' ); ?>
				
			<?php endif; ?>
		</div>
		<div class="amp-col-1-3">
			<?php if ( is_active_sidebar( 'sidebar-14' ) ) : ?>
				       
				<?php dynamic_sidebar( 'sidebar-14' ); ?>
				
			<?php endif; ?>
		</div>
		<div class="amp-col-1-3">
			<?php if ( is_active_sidebar( 'sidebar-15' ) ) : ?>
				            
				<?php dynamic_sidebar( 'sidebar-15' ); ?>
				
			<?php endif; ?>
		</div>			
	</div>
	
</footer>
<footer id="sub-footer">
	<div class="footer-wrapper amp-grid">				
		<span class="amp-footer-copyright"><?php echo get_option('ext_amp_general_options')['sub-footer-text']; ?></span>	

		<?php if( has_nav_menu('footer-menu') ) { wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'div', 'container_class' => 'footer_menu', 'container_id' => 'amp-footer-navigation') ); } ?>
	</div>
</footer>

</div>