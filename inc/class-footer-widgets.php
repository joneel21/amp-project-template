<?php

//register sidebar widgets
add_action( 'widgets_init', 'ext_amp_widgets_init' );

function ext_amp_widgets_init() {

    register_sidebar( array(
        'name' => __( 'AMP First Widget', 'ext_amp' ),
        'id' => 'amp-first-widget',
        'description' => __( 'This is intended for amp post page', 'ext_amp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
    ) );

    register_sidebar( array(
        'name' =>__( 'AMP Second Widget', 'ext_amp'),
        'id' => 'amp-second-widget',
        'description' => __( 'This is intended for amp post page', 'ext_amp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
    ) );

    register_sidebar( array(
        'name' =>__( 'AMP Third Widget', 'ext_amp'),
        'id' => 'amp-third-widget',
        'description' => __( 'This is intended for amp post page', 'ext_amp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
    ) );
} 


// Register and load the widget
function ext_amp_load_widget() {
	register_widget( 'ext_amp_form_widget' );
    register_widget( 'ext_amp_iframe_widget' );
}
add_action( 'widgets_init', 'ext_amp_load_widget' );

class ext_amp_iframe_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */	
    function __construct() {
        parent::__construct(

        // Base ID of your widget
        'ext_amp_iframe_widget', 

        // Widget name will appear in UI
        __('AMP Iframe', 'ext_amp_widget_domain'), 

        // Widget description
        array( 'description' => __( 'AMP Iframe for embedding content.', 'ext_amp_widget_domain' ), ) 
        );
    }

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
        $width = $instance['width'];
        $height = $instance['height'];
        $layout = $instance['layout'];
        $sandbox = $instance['sandbox'];
        $frameborder = $instance['frameborder'];
        $src = $instance['src'];        

        echo $args['before_widget'];
		
		$html = '<amp-iframe width="'.$width.'"';
        $html .= 'height="' . $height . '"';
        $html .= 'layout="' . $layout . '"';
        $html .= 'sandbox="' . $sandbox . '"';
        $html .= 'frameborder="' . $frameborder . '"';
        $html .= 'src="' . $src . '">';
        $html .= '</amp-iframe>';
        echo $html;
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
        $width = ! empty( $instance['width'] ) ? $instance['width'] : esc_html__( '500', 'ext_amp_widget_domain' );
        $height = ! empty( $instance['height'] ) ? $instance['height'] : esc_html__( '200', 'ext_amp_widget_domain' );
        $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( 'responsive', 'ext_amp_widget_domain' );
        $sandbox = ! empty( $instance['sandbox'] ) ? $instance['sandbox'] : esc_html__( 'allow-scripts allow-same-origin allow-popups', 'ext_amp_widget_domain' );
        $frameborder = ! empty( $instance['frameborder'] ) ? $instance['frameborder'] : esc_html__( '0', 'ext_amp_widget_domain' );
        $src = ! empty( $instance['src'] ) ? $instance['src'] : esc_html__( 'https://www.google.com/maps/embed/v1/place?q=10000+N+31st+Ave+d411,+Phoenix,+AZ+85051,+USA&key=AIzaSyCNCZ0Twm_HFRaZ5i-FuPDYs3rLwm4_848', 'ext_amp_widget_domain' );
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="number" value="<?php echo esc_attr( $width ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="number" value="<?php echo esc_attr( $height ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e( 'Layout:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" type="text" value="<?php echo esc_attr( $layout ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'sandbox' ); ?>"><?php _e( 'Sandbox:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'sandbox' ); ?>" name="<?php echo $this->get_field_name( 'sandbox' ); ?>" type="text" value="<?php echo esc_attr( $sandbox ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'frameborder' ); ?>"><?php _e( 'Frameborder:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'frameborder' ); ?>" name="<?php echo $this->get_field_name( 'frameborder' ); ?>" type="number" value="<?php echo esc_attr( $frameborder ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'src' ); ?>"><?php _e( 'Src:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'src' ); ?>" name="<?php echo $this->get_field_name( 'src' ); ?>" type="text" value="<?php echo esc_attr( $src ); ?>" />
        </p>
        <?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
        $instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
        $instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
        $instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';
        $instance['sandbox'] = ( ! empty( $new_instance['sandbox'] ) ) ? strip_tags( $new_instance['sandbox'] ) : '';
        $instance['frameborder'] = ( ! empty( $new_instance['frameborder'] ) ) ? strip_tags( $new_instance['frameborder'] ) : '';
        $instance['src'] = ( ! empty( $new_instance['src'] ) ) ? strip_tags( $new_instance['src'] ) : '';
        return $instance;
	}
}

// Creating the widget 
class ext_amp_form_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

        // Base ID of your widget
        'ext_amp_form_widget', 

        // Widget name will appear in UI
        __('AMP Inquiry Form', 'ext_amp_widget_domain'), 

        // Widget description
        array( 'description' => __( 'AMP Form extensions allows the usage of forms.', 'ext_amp_widget_domain' ), ) 
        );
    }

    // Creating widget front-end

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        //set xhr forms        
        $site_url = $_SERVER['SERVER_NAME'];       
        $xhr = '//'. $site_url .  '/wp-content/plugins/amp-project-template/template/submit.php';


        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        

        // This is where you run the code and display the output
        $html = '<form method="post" class="amp-form" action-xhr="' . $xhr . '" target="_top">';
        $html .= wp_nonce_field('ext_amp_contact_form', 'ext_amp_contact_form');
        $html .= '<div class="ampstart-input">';
        $html .= '<input type="text" class="input" name="name" placeholder="Name" required>';
        $html .= '<input type="text" class="input" name="company" placeholder="Company name" required>';
        $html .= '<input type="text" class="input" name="phone" placeholder="Phone" required>';
        $html .= '<input type="email" class="input" name="email" placeholder="Email" required>';
        $html .= '<textarea class="textarea" name="message" placeholder="Message"></textarea>';
        $html .= '<input type="submit" value="Send Message" class="ampstart-btn caps">';
        $html .= '<div submit-success>';
        $html .= '<template type="amp-mustache">';
        $html .= '{{successmsg}}';        
        $html .= ' </template></div>';  
        $html .= '<div submit-error>';
        $html .= '<template type="amp-mustache">';
        $html .= '{{errmsg}}';        
        $html .= ' </template></div>'; 
        $html .= '</div></form>';       
        echo $html; 
        echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'ext_amp_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
