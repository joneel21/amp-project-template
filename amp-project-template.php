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

class EXT_AMP_Template{
    const VER = '0.1-dev';
    const DB_VER = 1;

    public function bootstrap(){
        register_activation_hook(__FILE__, array( $this, 'activate') );
        add_action('admin_init', array( $this, 'register_ext_amp_settings') );
    }
    
    public function activate(){
        $this->init_options();
    }

    public function init_options(){
        update_option('ext_amp_tmpl_ver', SELF::VER);
        add_option('ext_amp_tmpl_db_ver', SELF::DB_VER);

        //set default value
        $default_values = array(
            'site-icon' => '',
            'site-logo' => '',
            'featured-img-default' => '',
            'amp-custom-css' => '',
            'amp-custom-element' => '',
            'amp-font' => '',
            'amp-analytics-code' => ''
        );

        add_option('ext_amp_tmpl_settings', $default_values);
        
    }

    public function register_ext_amp_settings(){
        register_setting( 'ext_amp_settings_group', 'ext_amp_tmpl_settings' );   
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
        'amp-mustache' => 'https://cdn.ampproject.org/v0/amp-mustache-0.1.js',
        'amp-bind' => 'https://cdn.ampproject.org/v0/amp-bind-0.1.js',
        'amp-social-share' => 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js'
        );
    $data['font_urls'] = array(
        'lato' => 'https://fonts.googleapis.com/css?family=Lato:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic|Josefin+Sans:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
        'josefinsans' => 'https://fonts.googleapis.com/css?family=Josefin+Sans:700,600,500,400',
        'fontawesome' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
    );

    return $data;
}


function ext_amp_load_template_actions(){
    require_once(EXT__AMP__DIR__ . '/inc/ext-amp-template-actions.php');
    require_once(EXT__AMP__DIR__ . '/inc/class-footer-widgets.php');
    require_once(EXT__AMP__DIR__ . '/inc/class-helper.php');
    /*require(EXT__AMP__DIR__ . '/template/submit.php');*/
}
ext_amp_load_template_actions();



class EXT_AMP_Settings_Page
{
    /**
     * Holds the values to be used in the fields callbacks
     */
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
        add_action( 'admin_init', array( $this, 'ext_amp_reg_forms' ) );  

        add_action( 'admin_enqueue_scripts', array($this, 'wp_enqueue_admin_assets') );      
        
    }
     public function bootstrap(){
        //register_activation_hook(__FILE__, array( $this, 'activate') );
        //register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        //add_action('admin_init', array( $this, 'register_ext_amp_settings') );
       
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        add_action( 'admin_init', array( $this, 'ext_amp_reg_forms' ) );

    }
    
    public function activate(){
      
        $this->init_options();   

    }
    public function ext_amp_general_options(){
        $this->class = new EXT_AMP_General_Options();
        $this->class->ext_amp_general_settings();
    }
    public function ext_amp_forms_options(){
        $this->class = new EXT_AMP_Forms_Options();
        $this->class->ext_amp_forms_settings();
    }
    public function deactivate(){
        /*delete_option('ext_amp_tmpl_settings');
        delete_option('ext_amp_reg_general_options');
        delete_option('ext_amp_forms_options');*/
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
        //add_option('ext_amp_tmpl_settings', $default_values);
        //add_option('ext_amp_tmpl_forms');
    
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        $itg_admin_menu = add_options_page(
            'EXT AMP Template', 
            'AMP Settings', 
            'manage_options', 
            'ext-amp-setting', 
            array( $this, 'create_admin_page' )
            //array($this, 'wp_enqueue_admin_assets')
        );

        //add_action('admin_print_style-' . $itg_admin_menu, array($this, 'wp_enqueue_admin_assets') );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        //$this->options['general'] = get_option( 'ext_amp_general_options' );
       
        $this->options['forms'] = get_option( 'ext_amp_tmpl_forms' );
        //var_dump(get_option('ext_amp_forms_options'));
        require 'views/settings-page.php';
       
    }

    public function wp_enqueue_admin_assets($hook){
        // Load only on ?page=mypluginname
        //wp_die($hook);
        if($hook != 'settings_page_ext-amp-setting') {
                return;
        }
        wp_enqueue_style('ext_amp_css', plugins_url() . '/amp-project-template/asset/css/ext-amp-settings.css', array(), false);
    }

    /**
     * Register and add settings
     */

     public function ext_amp_reg_forms(){
         register_setting(
             'ext_amp_reg_forms_group',
             'ext_amp_tmpl_forms'
         );

         add_settings_section(
             'ext_amp_forms_id',
             'Forms',
             array($this, 'ext_amp_reg_forms_desc'),
             'ext-amp-setting'
             
         );
         add_settings_field(
             'frm_to',
             'Send To',
             array($this, 'frm_send_to'),
             'ext-amp-setting',
             'ext_amp_forms_id'
         );
     }
    public function frm_send_to()
    {
        printf(
            '<input type="text" id="frm_to" name="ext_amp_tmpl_forms[frm_to]" value="%s" />',
            isset( $this->options['forms']['frm_to'] ) ? esc_attr( $this->options['forms']['frm_to']) : ''
        );
    }

     public function settings_description_pre($str){
         echo $str;
     }

     
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    public function raw_str_to_html($str){
        $str = (string)$str;
        $str = preg_replace('/&lt;/', '<', $str);
        $str = preg_replace('/&gt;/', '>', $str);
        $str = preg_replace('/&quot;/', '"', $str);
        $str = preg_replace('/&#039;/', "'", $str);
        return $str;
    }
    
}

require_once (EXT__AMP__DIR__ . '/views/options-general.php');
require_once (EXT__AMP__DIR__ . '/views/options-forms.php');

if( is_admin() ){
     $ext_amp_settings = new EXT_AMP_Settings_Page();    
}   