<?php

class EXT_AMP_General_Options extends EXT_AMP_Settings_Page {
    private $options;
    private $helper;

    public function __construct() {        
        //add_action( 'admin_init', array( $this, 'ext_amp_general_options' ) );        
        $this->helper = new EXT_AMP_Helper();
    }    
    public function ext_amp_general_settings()
     {               
        add_settings_section(
            'general_settings_section', // ID
            'General Settings', // Title
            array( $this, 'settings_description' ), // Callback
            'ext_amp_general_options' // Page
        );  

        register_setting(
            'ext_amp_general_options', // Option group
            'ext_amp_general_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );      


        add_settings_field(
            'site_logo', // ID
            'Logo', // Title 
            array( $this, 'site_logo_callback' ), // Callback
            'ext_amp_general_options', // Page
            'general_settings_section' // Section           
        );      
        add_settings_field(
            'default_image', 
            'Default image', 
            array( $this, 'default_image_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );  
        add_settings_field(
            'phone_number', 
            'Phone', 
            array( $this, 'phone_number_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        ); 
        add_settings_field(
            'body_font', 
            'Body Font', 
            array( $this, 'body_font_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );
        add_settings_field(
            'header_font', 
            'Header Font', 
            array( $this, 'header_font_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );
        add_settings_field(
            'extra_css', 
            'Extra CSS', 
            array( $this, 'extra_css_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        ); 

        

    }

    /** 
     * Get the settings option array and print one of its values
     */
    
    public function site_logo_callback(){
        $this->options = get_option('ext_amp_general_options');
        printf(
            '<input type="text" class="ext_input" id="site_logo" name="ext_amp_general_options[site-logo]" value="%s" />',
            isset( $this->options['site-logo'] ) ? esc_attr( $this->options['site-logo']) : ''
        );
        echo '<input id="upload_logo_button-site_logo" class="upload_logo button" data-targetId="site_logo" type="button" class="button" value="Upload Logo">';       
    }   
    public function default_image_callback()
    {
        $this->options = get_option('ext_amp_general_options');
        printf(
            '<input type="text" class="ext_input" id="default_image" name="ext_amp_general_options[default-image]" value="%s" />',
            isset( $this->options['default-image'] ) ? esc_attr( $this->options['default-image']) : ''
        );
        echo '<input id="upload_logo_button-default_image" class="upload_logo button" data-targetId="default_image" type="button" class="button" value="Upload Logo">'; 
    }

    public function phone_number_callback()
    {
        $this->options = get_option('ext_amp_general_options');

        printf(
            '<input type="text" class="ext_input" id="phone_number" name="ext_amp_general_options[phone-number]" value="%s" />',
            isset( $this->options['phone-number'] ) ? esc_attr( $this->options['phone-number']) : ''
        );
    } 
    public function body_font_callback()
    {                    
       
        $body_font = isset( $this->options['body-font'] ) ? esc_attr( $this->options['body-font']) : '-1';
        $html = '<select id="body_font" class="ext_select_font" name="ext_amp_general_options[body-font]" >';
        $html .= '<option value="-1">Select</option>';    
        $html .= $this->helper->generate_google_web_font($body_font);
        $html .= '</select>';

        echo $html;
    }
    public function header_font_callback()
    {                      
        $header_font = isset( $this->options['header-font'] ) ? esc_attr( $this->options['header-font']) : '-1';
        $html = '<select id="header_font" class="ext_select_font" name="ext_amp_general_options[header-font]" >';
        $html .= '<option value="-1">Select</option>';    
        $html .= $this->helper->generate_google_web_font($header_font);
        $html .= '</select>';

        echo $html;
    }
    public function extra_css_callback()
    {
        $this->options = get_option('ext_amp_general_options');
        printf(
            '<textarea type="text" rows="10" class="ext_input" id="extra_css" name="ext_amp_general_options[extra-css]"/>%s</textarea>',
            isset( $this->options['extra-css'] ) ? esc_attr( $this->options['extra-css']) : ''
        );
    } 

    
    public function sanitize( $input )
    {
        $new_input = array();
      
        if( isset( $input['site-logo'] ) )
            $new_input['site-logo'] = esc_url( $input['site-logo'] );

        if( isset( $input['phone-number'] ) )
            $new_input['phone-number'] = sanitize_text_field( $input['phone-number'] );

        if( isset( $input['default-image'] ) )
            $new_input['default-image'] = esc_url( $input['default-image'] );

        if( isset( $input['body-font'] ) )
            $new_input['body-font'] = sanitize_text_field($input['body-font'] );
        
        if( isset( $input['header-font'] ) )
            $new_input['header-font'] = sanitize_text_field($input['header-font'] );

        if( isset( $input['extra-css'] ) )
            $new_input['extra-css'] = $this->helper->sanitize_css_styling($input['extra-css'] );
            
        return $new_input;
    }
  
    /** 
     * Print the Section text
     */
    public function settings_description()
    {		              
        /*$result = $this->helper->get_google_web_font();
        $result = json_decode($result, true);*/
        echo get_option('ext_amp_general_options')['header-font'];
        $array1 = array(        
            'josefinsans' => 'https://fonts.googleapis.com/css?family=Josefin+Sans:700,600,500,400',
            'fontawesome' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
        );
        $array2 = array(
        'lato' => 'https://fonts.googleapis.com/css?family=Lato:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic|Josefin+Sans:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic'
        );
        //$data['font_urls'];
       /* $data['font_urls'] = array(        
            'josefinsans' => 'https://fonts.googleapis.com/css?family=Josefin+Sans:700,600,500,400',
            'fontawesome' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
        );*/
        $data['font_urls'] = array_merge($array1, $array2);
        var_dump($data);
        //print '<p>Enter your settings below:<p>';
        return;
    }

}