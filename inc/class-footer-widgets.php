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
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' =>__( 'AMP Second Widget', 'ext_amp'),
        'id' => 'amp-second-widget',
        'description' => __( 'This is intended for amp post page', 'ext_amp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' =>__( 'AMP Third Widget', 'ext_amp'),
        'id' => 'amp-third-widget',
        'description' => __( 'This is intended for amp post page', 'ext_amp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
} 


// Register and load the widget
function ext_amp_load_widget() {
	register_widget( 'ext_amp_form_widget' );
}
add_action( 'widgets_init', 'ext_amp_load_widget' );

// Creating the widget 
class ext_amp_form_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

        // Base ID of your widget
        'ext_amp_form_widget', 

        // Widget name will appear in UI
        __('AMP Inquiry Form', 'ext_amp_widget_domain'), 

        // Widget description
        array( 'description' => __( 'AMP Form', 'ext_amp_widget_domain' ), ) 
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
        $html .= '<div class="ampstart-input inline-block relative m0 p0 mb3">';
        $html .= '<input type="text" class="input" name="name" placeholder="Name" required>';
        $html .= '<input type="text" class="input" name="company" placeholder="Company name" required>';
        $html .= '<input type="text" class="input" name="phone" placeholder="Phone" required>';
        $html .= '<input type="email" class="input" name="email" placeholder="Email" required>';
        $html .= '<textarea class="textarea" name="message" placeholder="Message"></textarea>';
        $html .= '<input type="submit" value="Send Message" class="ampstart-btn caps">';
        $html .= '<div submit-success>';
        $html .= '<template type="amp-mustache">';
        $html .= 'Success! Thanks {{name}} {{email}} for trying the {{successmsg}}';        
        $html .= ' </template></div>';  
        $html .= '<div submit-error>';
        $html .= '<template type="amp-mustache">';
        $html .= 'Error! Thanks {{errmsg}} for trying';
        $html .= '{{#verifyErrors}}<p>{{message}}</p>{{/verifyErrors}}';
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
