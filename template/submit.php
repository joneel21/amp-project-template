<?php
//require_once('http://dev.meetbluefox.com/wp-load.php' );

$dir = dirname( __FILE__ );

$plugin_dir = explode('amp-project-template', $dir);
$abspath = explode('wp-content', $dir);

include($abspath[0]. 'wp-load.php');
include_once($plugin_dir[0]. 'amp-project-template\inc\class-helper.php');

$helper = new EXT_AMP_Helper();

$subject = $helper->get_option()['message'];

$arr = array('{Name}'=> 'Joneel', '{Email}' => 'joneel@99tasks.com');

echo $helper->find_replace_form_code($subject, $arr);

if( !empty($_POST) ){

    //--YOUR OTHER CODING--
    //...........

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
    }else{
        //--Assuming all validations are good here--
       /* if( empty($redirect_url) ){
            header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
        }
		else{
            header("AMP-Redirect-To: ".$redirect_url);
            header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");
        }*/

        //send mail
        $to = 'wolfenstein22.2009@gmail.com';
        $subject = 'Test Mail';
        $message = '<h2>Test</h2><br/><p>This is a test from ' . $_POST['name'] . '.</p>';
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: BlueFox Dev <info@rdtisoftdev.com>');
        
        $wp_mail = wp_mail($to, $subject, $message, $headers, $attachments);
		
		header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
		
        echo json_encode(
				array(
				'successmsg' =>	'My success message. [It will be displayed shortly(!) if with redirect]',
				'name' => $_POST['name'],
                'email' => $_POST['email'],
                'mailed' => $wp_mail
				)
			);
        die();
    }
}