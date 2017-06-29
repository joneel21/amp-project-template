<?php
$dir = dirname( __FILE__ );

$plugin_dir = explode('amp-project-template', $dir);
$abspath = explode('wp-content', $dir);

include($abspath[0]. 'wp-load.php');
include_once($plugin_dir[0]. 'amp-project-template/inc/class-helper.php');

$helper = new EXT_AMP_Helper();

if( isset($_POST['name']) && isset($_POST['email']) ){
    
    $option = get_option('ext_amp_forms_options');
    $to = $option['send-to'];
    $from_name = $option['from-name'];
    $from_email = $option['from-email'];
    $reply_to = $option['reply-to'];
    $bcc = $option['bcc'];
    $subject = $option['subject'];
    $message = $option['message'];
    $confirm_msg = $option['confirm-msg'];

    $form_values = array( '{Name}'=> sanitize_text_field($_POST['name']), '{Email}' => sanitize_email($_POST['email']), '{Company}' => sanitize_text_field($_POST['company']),'{Phone}' => sanitize_text_field($_POST['phone']), '{Message}' => sanitize_text_field($_POST['message']) );

    $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    //$redirect_url = 'https://example.com/forms/thank-you/'; //-->MUST BE 'https://';

    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: *.ampproject.org");
    header("AMP-Access-Control-Allow-Source-Origin: ".$domain_url);

    if( $_POST['email'] == 'email@test.com' ){ //-->SAMPLE Valiation!
        //-->Any 40X status code! 
        //Reference-1: https://github.com/ampproject/amphtml/issues/6058
        //Reference-2: http://php.net/manual/pt_BR/function.http-response-code.php
        header("HTTP/1.0 412 Precondition Failed", true, 412);
        echo json_encode(array('errmsg'=>'This email already exist!'));
        die();
    }
    elseif( !isset($_POST['ext_amp_contact_form']) || !wp_verify_nonce($_POST['ext_amp_contact_form'], 'ext_amp_contact_form')){
        header("HTTP/1.0 412 Precondition Failed", true, 412);
        echo json_encode(array('errmsg' => 'Sorry, your request did not verify!'));
        die();
    }
    else{
        //--Assuming all validations are good here--
       /* if( empty($redirect_url) ){
            header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
        }
		else{
            header("AMP-Redirect-To: ".$redirect_url);
            header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");
        }*/

        //send mail
        $to = $helper->find_replace_form_code($to, $form_values);
        $from_name = $helper->find_replace_form_code($from_name, $form_values);
        $from_email = $helper->find_replace_form_code($from_email, $form_values);
        
        $reply_to = $helper->find_replace_form_code($reply_to, $form_values);
        $bcc = $helper->find_replace_form_code($bcc, $form_values);

        $subject = $helper->find_replace_form_code($subject, $form_values);
        $message = $helper->find_replace_form_code($message, $form_values);       
       
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: '. $from_name .' <'. $from_email .'>');        
        
        if(!empty($reply_to)){
           $headers[] = 'Reply-To: ' . $reply_to; 
        }
        if(!empty($bcc)){
           $headers[] = 'Bcc: ' . $bcc; 
        }        

        $wp_mail = wp_mail($to, $subject, $message, $headers);
		
		header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
		
        echo json_encode(
				array(
				'successmsg' =>	$confirm_msg,				            
                'mailed' => $wp_mail
				)
			);
        die();
    }
}