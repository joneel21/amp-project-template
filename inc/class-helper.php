<?php

class EXT_AMP_Helper{
    private $option;
    private $ouput;
    
    public function raw_str_to_html($str){
        $str = (string)$str;
        $str = preg_replace('/&lt;/', '<', $str);
        $str = preg_replace('/&gt;/', '>', $str);
        $str = preg_replace('/&quot;/', '"', $str);
        $str = preg_replace('/&#039;/', "'", $str);
        return $str;
    }
    public function sanitize_css_styling($css){
        $clean_css            = strip_tags( $css );
        $clean_css            = wp_check_invalid_utf8( $clean_css );
        $clean_css            = _wp_specialchars( $clean_css, ENT_NOQUOTES );

        return $clean_css;
    }
    public function find_replace_form_code($str, $arr){
        //$short_code = array('{Name}' => $replace, '{Email}', '{Company}', '{Phone}', '{Message}');
        /*$code = count($arr);

        for($i = 0; $code < $i; $i++){
            $str = preg_replace($arr[$i], $value, $str);
        }*/
        foreach($arr as $key => $value){
            $str = preg_replace('/'.$key.'/', $value, $str);
        }
        return $str;
    }  
    public function custom_selected($option, $value){
        
    } 
    public function generate_google_web_font($option_name){
        $web_font_url = EXT__AMP__DIR__ . '/asset/font/google_font_6-30-17.json';
        $web_font = file_get_contents($web_font_url);
        $web_font = json_decode($web_font, true);
        $count_font_list = count($web_font['items']);        
        $generate_font_list = array();
        $html_output = '';
        for($i = 0; $i < $count_font_list; $i++){
            if($i==1) break;
            //$web_font = $web_font['items'][$i];
            $font_famliy = preg_replace('/ /', '+', $web_font['items'][$i]['family']);
            $variants = implode(',', $web_font['items'][$i]['variants']);
            $font_url = 'https://fonts.googleapis.com/css?family=' . $font_famliy . ':' . $variants; 
            $font_name = $web_font['items'][$i]['family'];
            $generate_font_list[$font_name] = $font_url;           
        }
       
         for($i = 0; $i < $count_font_list; $i++){            
            $font_famliy = preg_replace('/ /', '+', $web_font['items'][$i]['family']);
            $variants = implode(',', $web_font['items'][$i]['variants']);
            $body_font = $font_famliy . ':' . $variants; 
            $font_name = $web_font['items'][$i]['family'];              
            $html_output .= '<option value="'.$body_font.'" '.selected($option_name, $body_font, false).'>'.$font_name.'</option>';      
        }

        return $html_output;

    }
    public function extract_google_web_font($font){      
        $font = explode(':', $font)[0];
        $font = preg_replace("/\+/", ' ', $font);
        return $font;
    }
    public function get_google_web_font(){
        $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAAs8YkBD-38XV-s3huhCHIgFbGc8YISTs';
        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($cURL, CURLOPT_HTTPGET, true);
        /*curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));*/
        //curl_setopt($cURL, CURLOPT_HEADER, false);
        curl_setopt($cURL, CURLOPT_HEADER, 0);  
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($cURL);
        curl_close($cURL);
        return $result;
        /*var_dump($result);
        $json = json_decode($result, true);        
        print_r($json);*/
    }
}