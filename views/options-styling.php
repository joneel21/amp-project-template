<?php

class EXT_AMP_Styling_Options extends EXT_AMP_Settings_Page {
    private $options;
    private $helper;

    public function __construct() {        
        //add_action( 'admin_init', array( $this, 'ext_amp_styling_options' ) );        
        $this->helper = new EXT_AMP_Helper();
    }    
    public function ext_amp_styling_settings()
     {               
        add_settings_section(
            'styling_settings_section', // ID
            'AMP Design', // Title
            array( $this, 'settings_description' ), // Callback
            'ext_amp_styling_options' // Page
        );  

        register_setting(
            'ext_amp_styling_options', // Option group
            'ext_amp_styling_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );      


        add_settings_field(
            'text_color', // ID
            'Text Color', // Title 
            array( $this, 'text_color_callback' ), // Callback
            'ext_amp_styling_options', // Page
            'styling_settings_section' // Section           
        );     
        add_settings_field(
            'link_color', // ID
            'Link Color', // Title 
            array( $this, 'link_color_callback' ), // Callback
            'ext_amp_styling_options', // Page
            'styling_settings_section' // Section           
        );     
        

    }

    /** 
     * Get the settings option array and print one of its values
     */
    
    public function text_color_callback(){
        $this->options = get_option('ext_amp_styling_options');
        printf(
            '<input type="text" class="amp-color-picker hide-field" id="text_color" name="ext_amp_styling_options[text-color]" value="%s" />',
            isset( $this->options['text-color'] ) ? esc_attr( $this->options['text-color']) : ''
        );        
    }   
    public function link_color_callback(){
        $this->options = get_option('ext_amp_styling_options');
        printf(
            '<input type="text" class="amp-color-picker hide-field" id="link_color" name="ext_amp_styling_options[link-color]" value="%s" />',
            isset( $this->options['link-color'] ) ? esc_attr( $this->options['link-color']) : ''
        );        
    }     

    
    public function sanitize( $input )
    {
        $new_input = array();
        $this->options = get_option('ext_amp_styling_options');

        // Validate Background Color
        $colors = array(
            'text-color',
            'link-color'
        );
       
        //add_settings_error('styling_settings_section', 'color-invalid', "Insert a valid color for ".$input['text-color']." field!", 'error');
        foreach($colors as $color){
            $sanitize_color = trim( $input[$color] );
            $sanitize_color = strip_tags(stripslashes($sanitize_color));
            // Check if is a valid hex color     
            if(empty($input[$color]) || $input[$color] === NULL){
                $new_input[$color] = '';
            }         
            else{
                $new_input[$color] = (FALSE === $this->check_color($sanitize_color) ? $this->options[$color] : $sanitize_color);
            } 
            
        }       
        
        return $new_input;
    }
    /**
    * Function that will check if value is a valid HEX color.
    */
    public function check_color( $value ) { 
        
        if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #     
            return true;
        }
        
        return false;
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