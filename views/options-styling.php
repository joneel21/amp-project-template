<?php

class EXT_AMP_Styling_Options extends EXT_AMP_Settings_Page {
    private $options;
    private $helper;

    public function __construct() {        
        //add_action( 'admin_init', array( $this, 'ext_amp_styling_options' ) );        
        $this->helper = new EXT_AMP_Helper();
        $this->options = get_option('ext_amp_styling_options');
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
            'body_font', 
            'Body Font', 
            array( $this, 'body_font_callback' ), 
            'ext_amp_styling_options', 
            'styling_settings_section'
        );
        add_settings_field(
            'header_font', 
            'Header Font', 
            array( $this, 'header_font_callback' ), 
            'ext_amp_styling_options', 
            'styling_settings_section'
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
        
        add_settings_field(
            'extra_css', 
            'Extra CSS', 
            array( $this, 'extra_css_callback' ), 
            'ext_amp_styling_options', 
            'styling_settings_section'
        ); 
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function body_font_callback()
    {                    
        
        $body_font = isset( $this->options['body-font'] ) ? esc_attr( $this->options['body-font']) : '-1';       
        $html = '<select id="body_font" class="ext_select_font" name="ext_amp_styling_options[body-font]" >';
        $html .= '<option value="-1">Select</option>';    
        $html .= $this->helper->generate_google_web_font($body_font);
        $html .= '</select>';
       
        echo $html;
    }
    public function header_font_callback()
    {                             

        $header_font = isset( $this->options['header-font'] ) ? esc_attr( $this->options['header-font']) : '-1';
        $html = '<select id="header_font" class="ext_select_font" name="ext_amp_styling_options[header-font]" >';
        $html .= '<option value="-1">Select</option>';    
        $html .= $this->helper->generate_google_web_font($header_font);
        $html .= '</select>';

        echo $html;
    }
    public function text_color_callback(){        
        printf(
            '<input type="text" class="amp-color-picker hide-field" id="text_color" name="ext_amp_styling_options[text-color]" value="%s" />',
            isset( $this->options['text-color'] ) ? esc_attr( $this->options['text-color']) : ''
        );        
    }   
    public function link_color_callback(){
        printf(
            '<input type="text" class="amp-color-picker hide-field" id="link_color" name="ext_amp_styling_options[link-color]" value="%s" />',
            isset( $this->options['link-color'] ) ? esc_attr( $this->options['link-color']) : ''
        );        
    }     
    public function extra_css_callback()
    {        
        printf(
            '<textarea type="text" rows="10" class="ext_input" id="extra_css" name="ext_amp_styling_options[extra-css]"/>%s</textarea>',
            isset( $this->options['extra-css'] ) ? esc_attr( $this->options['extra-css']) : ''
        );
    } 
    
    public function sanitize( $input )
    {
        $new_input = array();
        
        if( isset( $input['body-font'] ) ){
            $body_font =& $new_input['body-font'];
            $new_input['body-font'] = sanitize_text_field($input['body-font'] );
            $new_input['body-font-name'] = $body_font != '-1' ? $this->helper->extract_google_web_font($body_font) : '';
        }           
        
        if( isset( $input['header-font'] ) ){
            $header_font =& $new_input['header-font'];
            $new_input['header-font'] = sanitize_text_field($input['header-font'] );
            $new_input['header-font-name'] =  $header_font != '-1' ? $this->helper->extract_google_web_font($header_font) : '';
        }
            

        if( isset( $input['extra-css'] ) )
            $new_input['extra-css'] = $this->helper->sanitize_css_styling($input['extra-css'] );

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
        var_dump(get_option('ext_amp_styling_options'));
        //print '<p>Enter your settings below:<p>';
        return;
    }

}