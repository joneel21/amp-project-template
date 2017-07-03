<footer id="amp-footer-top">
	<div class="footer-wrapper amp-grid">	
		<div class="amp-padding-wrapper">	
			<div class="amp-col-1-3">
				<div class="col-widget">
				<?php if ( is_active_sidebar( 'amp-first-widget' ) ) : ?>
				          
					<?php dynamic_sidebar( 'amp-first-widget' ); ?>
				
				<?php endif; ?>
				</div>
			</div>
			<div class="amp-col-1-3">
				<div class="col-widget">
				<?php if ( is_active_sidebar( 'amp-second-widget' ) ) : ?>
					           
					<?php dynamic_sidebar( 'amp-second-widget' ); ?>
					
				<?php endif; ?>
				</div>
			</div>
			<div class="amp-col-1-3">
				<div class="col-widget">
				<?php if ( is_active_sidebar( 'amp-third-widget' ) ) : ?>
					           
					<?php dynamic_sidebar( 'amp-third-widget' ); ?>
				
				<?php endif; ?>
				</div>
			</div>	
		</div>	
	</div>	
</footer>

<footer class="amp-wp-footer1" id="amp-footer">
	<div class="footer-wrapper">		
		<div class="amp-col-1-3">			
			<?php if ( is_active_sidebar( 'sidebar-13' ) ) : ?>
				        
				<?php dynamic_sidebar( 'sidebar-13' ); ?>
				
			<?php endif; ?>
		</div>
		<div class="amp-col-1-3">
			<div class="widgettitle">Quick Navigation</div>
		</div>
		<div class="amp-col-1-3">
			<div class="widgettitle">Legal Terms</div>
		</div>		
	</div>
	
</footer>
<footer id="sub-footer">
	<div class="footer-wrapper">		
	<span class="amp-footer-copyright">Copyright All Rights Reserved © 2017</span>	
	</div>	
</footer>
