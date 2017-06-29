<?php

class EXT_AMP_General_Options {
    private $options;

    public function __construct() {        
        //add_action( 'admin_init', array( $this, 'ext_amp_general_options' ) );        
        
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
            'ext_amp_general_options' // Option name
            //array( $this, 'sanitize' ) // Sanitize
        );      


        add_settings_field(
            'site_logo', // ID
            'Logo', // Title 
            array( $this, 'site_logo_callback' ), // Callback
            'ext_amp_general_options', // Page
            'general_settings_section' // Section           
        );      

        add_settings_field(
            'phone_number', 
            'Phone', 
            array( $this, 'phone_number_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        ); 
        add_settings_field(
            'social_icon', 
            'Social icon', 
            array( $this, 'social_menu_callback' ), 
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
            '<input type="text" id="site_logo" name="ext_amp_general_options[site-logo]" value="%s" />',
            isset( $this->options['site-logo'] ) ? esc_attr( $this->options['site-logo']) : ''
        );
    }   

    public function phone_number_callback()
    {
        $this->options = get_option('ext_amp_general_options');
        printf(
            '<input type="text" id="phone_number" name="ext_amp_general_options[phone-number]" value="%s" />',
            isset( $this->options['phone-number'] ) ? esc_attr( $this->options['phone-number']) : ''
        );
    } 

    public function social_menu_callback()
    {
        $this->options = get_option('ext_amp_general_options');
        printf(
            '<input type="text" id="social_icon" name="ext_amp_general_options[social-icon]" value="%s" />',
            isset( $this->options['social-icon'] ) ? esc_attr( $this->options['social-icon']) : ''
        );
    }
 
    /** 
     * Print the Section text
     */
    public function settings_description()
    {		
        var_dump(get_option('ext_amp_general_options'));
        //print '<p>Enter your settings below:<p>';
        return;
    }

}

new EXT_AMP_General_Options();
