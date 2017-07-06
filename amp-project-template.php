<?php 
    /*
    Plugin Name: AMP Extension Template
    Plugin URI: https://www.meetbluefox.com
    Description: Extended AMP template for posts page only. This plugin requires AMP by automattic to work properly.
    Author: BlueFox Developer
    Version: 1.0
    Author URI: https://www.meetbluefox.com
    */

define( 'EXT__AMP__FILE__', __FILE__ );
define( 'EXT__AMP__DIR__', dirname( __FILE__ ) );
class EXT_AMP_Settings_Page
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    const VER = '0.1-dev';
    const DB_VER = 1;

    private $options;
    private $options_forms;
    private $class;
    //private $general_options = EXT_AMP_General_Options;
    /**
     * Start up
     */
    public function __construct()
    {
        
        register_activation_hook(__FILE__, array( $this, 'activate') );
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        //$this->init_options(); 

        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'ext_amp_general_options' ) );
        add_action( 'admin_init', array( $this, 'ext_amp_forms_options' ) ); 

        add_action( 'admin_enqueue_scripts', array($this, 'wp_enqueue_admin_assets') );      

        //add_action( 'amp_post_template_head', array($this, 'ext_amp_post_head_meta') );


        
    }    
    function ext_amp_post_head_meta(){
        echo '<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.1.js"></script>';
    }
    public function activate(){      
        $this->init_options();   
        update_option('ext_amp_tmpl_ver', SELF::VER);
        add_option('ext_amp_tmpl_db_ver', SELF::DB_VER);    
    }
    public function deactivate(){
        /*delete_option('ext_amp_tmpl_settings');
        delete_option('ext_amp_reg_general_options');
        delete_option('ext_amp_forms_options');*/
    }

    /**
     * Register and add settings
     */
    public function ext_amp_general_options(){
        $this->class = new EXT_AMP_General_Options();
        $this->class->ext_amp_general_settings();
    }
    public function ext_amp_forms_options(){
        $this->class = new EXT_AMP_Forms_Options();
        $this->class->ext_amp_forms_settings();
    }    
    
    public function init_options(){
        //set default value
        $default_values = array(
            'site-icon' => '',
            'site-logo' => 'location',
            'featured-img-default' => '',
            'amp-custom-css' => '',
            'amp-custom-element' => '',
            'amp-font' => '',
            'amp-analytics-code' => ''
        );
        
        $default_form_values = array(
            'send-to' => get_bloginfo('admin_email'),
            'from-name' => get_bloginfo('name'),
            'from-email' => get_bloginfo('admin_email'),
            'reply-to' => '',
            'bcc' => '',
            'subject' => 'Contact Form Inquiry via AMP - {Name}',
            'message' => 'G\'Day,<br/><br/>You have a message came from (AMP) mobile device  via ' . get_bloginfo('url') . '. Kindly check the details below. Thank you!<br/><br/>Full Name: {Name}<br/>Company Name: {Company}<br/>Email: {Email}<br/>Phone: {Phone}<br/>Message: {Message}<br/>',
            'confirm-msg' => 'Thanks for contacting us! We will get in touch with you shortly.'
        );

        if( false == get_option( 'ext_amp_general_options' ) ) {  
            add_option( 'ext_amp_general_options' );
        }    
        if( false == get_option( 'ext_amp_forms_options' ) ) {  
            add_option( 'ext_amp_forms_options', $default_form_values );
        }        
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'EXT AMP Template', 
            'AMP Extension', 
            'manage_options', 
            'ext-amp-setting', 
            array( $this, 'create_admin_page' )            
        );        
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {       
        require 'views/settings-page.php';       
    }

    public function wp_enqueue_admin_assets($hook){
        // Load only on ?page=mypluginname
        //wp_die($hook);
        if($hook != 'settings_page_ext-amp-setting') {
                return;
        }        
        wp_enqueue_script('jquery'); 
        wp_enqueue_script('jquery-ui-core');
        /*
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox'); */
        wp_enqueue_media();

        wp_enqueue_style('ext_amp_css', plugins_url() . '/amp-project-template/asset/css/ext-amp-settings.css', array(), false);
        wp_enqueue_script('ext_amp_js', plugins_url() . '/amp-project-template/asset/js/ext-amp-media-upload.js', array('jquery', 'jquery-ui-core'), false); 
           
    }   
   
}


/*function sample_admin_notice__error() {
	$class = 'notice notice-error';
	$message = __( 'Irks! An error has occurred.', 'sample-text-domain' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}
add_action( 'admin_notices', 'sample_admin_notice__error' );*/



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
     
    $get_body_font = get_option('ext_amp_general_options')['body-font'];
    $get_header_font = get_option('ext_amp_general_options')['header-font'];
   
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
    $ext_amp_css = get_option('ext_amp_general_options');
    echo $ext_amp_css['extra-css'];
}

function ext_amp_load_template_actions(){
    require_once(EXT__AMP__DIR__ . '/inc/ext-amp-template-actions.php');
    require_once(EXT__AMP__DIR__ . '/inc/class-footer-widgets.php');
    require_once(EXT__AMP__DIR__ . '/inc/class-helper.php');
    /*require(EXT__AMP__DIR__ . '/template/submit.php');*/
}
ext_amp_load_template_actions();

require_once (EXT__AMP__DIR__ . '/views/options-general.php');
require_once (EXT__AMP__DIR__ . '/views/options-forms.php');

if( is_admin() ){
     $ext_amp_settings = new EXT_AMP_Settings_Page();    
}   