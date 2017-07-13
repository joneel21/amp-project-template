<?php 
    /*
    Plugin Name: AMP Extension Template
    Plugin URI: https://www.meetbluefox.com
    Description: Extended AMP template for posts page only. This plugin requires AMP by automattic to work properly.
    Author: BlueFox Developer
    Version: 1.0
    Text Domain: ext-amp
    Author URI: https://www.meetbluefox.com
    */

define( 'EXT__AMP__FILE__', __FILE__ );
define( 'EXT__AMP__DIR__', dirname( __FILE__ ) );
define( 'EXT__AMP__URL__', plugins_url() . '/amp-project-template');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

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

    /**
     * Start up
     */
    public function __construct()
    {
        $amp_check = plugin_dir_path(__DIR__) . 'amp/amp.php';
        if( !file_exists( $amp_check ) || !is_plugin_active( 'amp/amp.php' ) ){
            add_action( 'admin_notices', array($this, 'admin_notice__error') );             
        } 
        
        register_activation_hook(__FILE__, array( $this, 'activate') );
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        //$this->init_options(); 

        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'ext_amp_general_options' ) );
        add_action( 'admin_init', array( $this, 'ext_amp_styling_options' ) );
        add_action( 'admin_init', array( $this, 'ext_amp_forms_options' ) ); 

        add_action( 'admin_enqueue_scripts', array($this, 'wp_enqueue_admin_assets') );     
        
    }    
    
    public function activate(){ 
        
        $this->init_options();   

        //update_option('ext_amp_tmpl_ver', SELF::VER);
        //add_option('ext_amp_tmpl_db_ver', SELF::DB_VER);    
    }
    public function deactivate(){
       
    }

    /**
     * Register and add settings
     */
    public function ext_amp_general_options(){
        $this->class = new EXT_AMP_General_Options();
        $this->class->ext_amp_general_settings();
    }
    public function ext_amp_styling_options(){
        $this->class = new EXT_AMP_Styling_Options();
        $this->class->ext_amp_styling_settings();
    }   
    public function ext_amp_forms_options(){
        $this->class = new EXT_AMP_Forms_Options();
        $this->class->ext_amp_forms_settings();
    }  
    
    public function init_options(){
        //set default value
        $default_general_values = array(
            'site-icon' => '',
            'default-image' => '',
            'phone-number' => '',
            'facebook' => '',
            'google-plus' => '',
            'twitter' => '',
            'linkedin' => '',
            'youtube' => '',
            'instagram' => '',
            'sub-footer-text' => 'Copyright All Rights Reserved &copy; ' . date('Y')
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
            add_option( 'ext_amp_general_options', $default_general_values );
        }    
        if( false == get_option( 'ext_amp_styling_options' ) ) {  
            add_option( 'ext_amp_styling_options' );
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
        wp_enqueue_media();
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_style('ext_amp_css', EXT__AMP__URL__ . '/asset/css/ext-amp-settings.css', array(), false);
        wp_enqueue_script('ext_amp_js', EXT__AMP__URL__ . '/asset/js/ext-amp-media-upload.js', array('jquery', 'jquery-ui-core'), false); 
        wp_enqueue_script( 'ext_amp_color_picker', EXT__AMP__URL__ . '/asset/js/ext-amp-color-picker.js', array( 'wp-color-picker' ), false, false ); 
           
    }   
    
    public function admin_notice__error() {
        $class = 'notice notice-error';
        
        $message = __( 'AMP Plugin by Automattic is required for AMP Extension Template to work.', 'ext-amp' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    }  

}

function ext_amp_load_template_actions(){
    require_once (EXT__AMP__DIR__ . '/views/options-general.php');
    require_once (EXT__AMP__DIR__ . '/views/options-styling.php');
    require_once (EXT__AMP__DIR__ . '/views/options-forms.php');
    require_once(EXT__AMP__DIR__ . '/inc/ext-amp-template-actions.php');
    require_once(EXT__AMP__DIR__ . '/inc/class-footer-widgets.php');
    require_once(EXT__AMP__DIR__ . '/inc/class-helper.php');    
    /*require(EXT__AMP__DIR__ . '/template/submit.php');*/
}
ext_amp_load_template_actions();

if( is_admin() ){
     $ext_amp_settings = new EXT_AMP_Settings_Page();    
}   