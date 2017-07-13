<?php

class EXT_AMP_Forms_Options extends EXT_AMP_Settings_Page{
    private $options;
    private $description;
    private $helper;
   
    public function __construct() {       
      //$this->description = parent::settings_description("Tets");
      $this->helper = new EXT_AMP_Helper();
      $this->options = get_option('ext_amp_forms_options');
    }    
   
    public function ext_amp_forms_settings()
     {               
        add_settings_section(
            'forms_settings_section', // ID
            'Forms Settings', // Title
            array( $this, 'settings_description' ), // Callback
            'ext_amp_forms_options' // Page
        );  

        register_setting(
            'ext_amp_forms_options', // Option group
            'ext_amp_forms_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );      


        add_settings_field(
            'send_to', // ID
            'Send to Email', // Title 
            array( $this, 'send_to_callback' ), // Callback
            'ext_amp_forms_options', // Page
            'forms_settings_section' // Section           
        );      

        add_settings_field(
            'from_name', 
            'From Name', 
            array( $this, 'from_name_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        ); 
        add_settings_field(
            'from_email', 
            'From Email', 
            array( $this, 'from_email_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        );  
        add_settings_field(
            'reply_to', 
            'Reply To', 
            array( $this, 'reply_to_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        ); 
        add_settings_field(
            'bcc', 
            'BCC', 
            array( $this, 'bcc_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        ); 
        add_settings_field(
            'subject', 
            'Subject', 
            array( $this, 'subject_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        );  
        add_settings_field(
            'message', 
            'Message', 
            array( $this, 'message_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        );  
         add_settings_field(
            'confirm_msg', 
            'Confirmation Message', 
            array( $this, 'confirm_msg_callback' ), 
            'ext_amp_forms_options', 
            'forms_settings_section'
        );

    }

     /** 
     * Get the settings option array and print one of its values
     */
    
    public function send_to_callback(){
       
        printf(
            '<input type="email" id="send_to" class="ext_input" name="ext_amp_forms_options[send-to]" value="%s" />',
            isset( $this->options['send-to'] ) ? esc_attr( $this->options['send-to']) : ''
        );
    } 
    public function from_name_callback(){
        
        printf(
            '<input type="text" id="from_name" class="ext_input" name="ext_amp_forms_options[from-name]" value="%s" />',
            isset( $this->options['from-name'] ) ? esc_attr( $this->options['from-name']) : ''
        );
    }
    public function from_email_callback(){
        
        printf(
            '<input type="email" id="from_email" class="ext_input" name="ext_amp_forms_options[from-email]" value="%s" />',
            isset( $this->options['from-email'] ) ? esc_attr( $this->options['from-email']) : ''
        );
    } 
    public function reply_to_callback(){
       
        printf(
            '<input type="email" id="reply_to" class="ext_input" name="ext_amp_forms_options[reply-to]" value="%s" />',
            isset( $this->options['reply-to'] ) ? esc_attr( $this->options['reply-to']) : ''
        );
    } 
    public function bcc_callback(){
       
        printf(
            '<input type="email" id="bcc" class="ext_input" name="ext_amp_forms_options[bcc]" value="%s" />',
            isset( $this->options['bcc'] ) ? esc_attr( $this->options['bcc']) : ''
        );
    } 
    public function subject_callback(){
        
        printf(
            '<input type="text" id="subject" class="ext_input" name="ext_amp_forms_options[subject]" value="%s" />',
            isset( $this->options['subject'] ) ? esc_attr( $this->options['subject']) : ''
        );
    }
    public function message_callback(){
        
        $settings = array(
                'wpautop' => false,
                'media_buttons' => true,
                'textarea_name' => 'ext_amp_forms_options[message]'        
                );
        $content = isset( $this->options['message'] ) ? esc_attr( $this->options['message']) : '';
            
        $content = $this->helper->raw_str_to_html($content);
       
        wp_editor( $content, 'ext-amp-form-message', $settings );
        
        /*printf(
            '<textarea id="message" cols="25" row="25" name="ext_amp_forms_options[message]">%s</textarea>',
            isset( $this->options['message'] ) ? esc_attr( $this->options['message']) : ''
        );*/
    }    
    public function confirm_msg_callback(){
              
        printf(
            '<input type="text" id="confirm_msg" class="ext_input_full_width" name="ext_amp_forms_options[confirm-msg]" value="%s" />',
            isset( $this->options['confirm-msg'] ) ? esc_attr( $this->options['confirm-msg']) : ''
        );
    }

     /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['send-to'] ) )
            $new_input['send-to'] = sanitize_email( $input['send-to'] );

        if( isset( $input['from-name'] ) )
            $new_input['from-name'] = sanitize_text_field( $input['from-name'] );
        
        if( isset( $input['from-email'] ) )
            $new_input['from-email'] = sanitize_email( $input['from-email'] );
        
        if( isset( $input['reply-to'] ) )
            $new_input['reply-to'] = sanitize_email( $input['reply-to'] );
        
        if( isset( $input['bcc'] ) )
            $new_input['bcc'] = sanitize_email( $input['bcc'] );
        
        if( isset( $input['subject'] ) )
            $new_input['subject'] = sanitize_text_field( $input['subject'] );
        
        if( isset( $input['message'] ) )
            $new_input['message'] = wp_kses_post( $input['message'] );

        if( isset( $input['confirm-msg'] ) )
            $new_input['confirm-msg'] = sanitize_text_field( $input['confirm-msg'] );

        return $new_input;
    }
     public function settings_description(){
        echo "Mail settings for the recipient after form submission.";      
    }
}