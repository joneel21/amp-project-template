<?php

class EXT_AMP_General_Options extends EXT_AMP_Settings_Page {
    private $options;
    private $helper;

    public function __construct() {        
        //add_action( 'admin_init', array( $this, 'ext_amp_general_options' ) );        
        $this->helper = new EXT_AMP_Helper();
        $this->options = get_option('ext_amp_general_options');
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
            'facebook', 
            'Facebook', 
            array( $this, 'facebook_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        ); 
        add_settings_field(
            'google-plus', 
            'Google+', 
            array( $this, 'google_plus_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );
        add_settings_field(
            'twitter', 
            'Twitter', 
            array( $this, 'twitter_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        ); 
        add_settings_field(
            'linkedin', 
            'LinkedIn', 
            array( $this, 'linkedin_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        ); 
        add_settings_field(
            'youtube', 
            'Youtube', 
            array( $this, 'youtube_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );
        add_settings_field(
            'instagram', 
            'Instagram', 
            array( $this, 'instagram_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );
        
        add_settings_field(
            'sub_footer_text', 
            'Sub Footer Copyright Text', 
            array( $this, 'sub_footer_text_callback' ), 
            'ext_amp_general_options', 
            'general_settings_section'
        );

    }

    /** 
     * Get the settings option array and print one of its values
     */
    
    public function site_logo_callback(){
        
        printf(
            '<input type="text" class="ext_input" id="site_logo" name="ext_amp_general_options[site-logo]" value="%s" />',
            isset( $this->options['site-logo'] ) ? esc_attr( $this->options['site-logo']) : ''
        );
        echo '<input id="upload_logo_button-site_logo" class="upload_logo button" data-targetId="site_logo" type="button" class="button" value="Upload Logo">';       
    }   
    public function default_image_callback()
    {
        
        printf(
            '<input type="text" class="ext_input" id="default_image" name="ext_amp_general_options[default-image]" value="%s" />',
            isset( $this->options['default-image'] ) ? esc_attr( $this->options['default-image']) : ''
        );
        echo '<input id="upload_logo_button-default_image" class="upload_logo button" data-targetId="default_image" type="button" class="button" value="Upload Logo">'; 
    }

    public function phone_number_callback()
    {
        
        printf(
            '<input type="text" class="ext_input" id="phone_number" name="ext_amp_general_options[phone-number]" value="%s" />',
            isset( $this->options['phone-number'] ) ? esc_attr( $this->options['phone-number']) : ''
        );
    } 
    public function facebook_callback()
    {
       
        printf(
            '<input type="text" class="ext_input" id="facebook" name="ext_amp_general_options[facebook]" value="%s" />',
            isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
        );
    }     
    public function google_plus_callback()
    {
          
        printf(
            '<input type="text" class="ext_input" id="google_plus" name="ext_amp_general_options[google-plus]" value="%s" />',
            isset( $this->options['google-plus'] ) ? esc_attr( $this->options['google-plus']) : ''
        );
    }
    public function twitter_callback()
    {
            
        printf(
            '<input type="text" class="ext_input" id="twitter" name="ext_amp_general_options[twitter]" value="%s" />',
            isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
        );
    }
    public function linkedin_callback()
    {
            
        printf(
            '<input type="text" class="ext_input" id="linkedin" name="ext_amp_general_options[linkedin]" value="%s" />',
            isset( $this->options['linkedin'] ) ? esc_attr( $this->options['linkedin']) : ''
        );
    }
    public function youtube_callback()
    {
              
        printf(
            '<input type="text" class="ext_input" id="youtube" name="ext_amp_general_options[youtube]" value="%s" />',
            isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
        );
    }
    public function instagram_callback()
    {
             
        printf(
            '<input type="text" class="ext_input" id="instagram" name="ext_amp_general_options[instagram]" value="%s" />',
            isset( $this->options['instagram'] ) ? esc_attr( $this->options['instagram']) : ''
        );
    }
    
    public function sub_footer_text_callback()
    {        
        
        printf(
            '<textarea type="text" rows="10" class="ext_input" id="sub_footer_text" name="ext_amp_general_options[sub-footer-text]"/>%s</textarea>',
            isset( $this->options['sub-footer-text'] ) ? $this->options['sub-footer-text'] : esc_attr( $this->options['sub-footer-text'])
        );
    } 
    
    
    public function sanitize( $input )
    {
        $new_input = array();
      
        if( isset( $input['site-logo'] ) )
            $new_input['site-logo'] = esc_url( $input['site-logo'] );

        if( isset( $input['phone-number'] ) )
            $new_input['phone-number'] = sanitize_text_field( $input['phone-number'] );
        
        if( isset( $input['facebook'] ) )
            $new_input['facebook'] = esc_url( $input['facebook'] );
        
        if( isset( $input['google-plus'] ) )
            $new_input['google-plus'] = esc_url( $input['google-plus'] );
        
        if( isset( $input['twitter'] ) )
            $new_input['twitter'] = esc_url( $input['twitter'] );

        if( isset( $input['linkedin'] ) )
            $new_input['linkedin'] = esc_url( $input['linkedin'] );
        
        if( isset( $input['youtube'] ) )
            $new_input['youtube'] = esc_url( $input['youtube'] );
        
        if( isset( $input['instagram'] ) )
            $new_input['instagram'] = esc_url( $input['instagram'] );

        if( isset( $input['default-image'] ) )
            $new_input['default-image'] = esc_url( $input['default-image'] );
 
        if( isset( $input['sub-footer-text'] ) )
            $new_input['sub-footer-text'] = wp_kses($input['sub-footer-text'], array( 'strong' => array(), 'a' => array("href" => array() ), 'span' => array() ) );
       
        return $new_input;
    }
  
    /** 
     * Print the Section text
     */
    public function settings_description()
    {	                         
        //print '<p>Enter your settings below:<p>';
        return;
    }

}