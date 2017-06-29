<?php

class EXT_AMP_Helper{
    private $option;
    
    public function raw_str_to_html($str){
        $str = (string)$str;
        $str = preg_replace('/&lt;/', '<', $str);
        $str = preg_replace('/&gt;/', '>', $str);
        $str = preg_replace('/&quot;/', '"', $str);
        $str = preg_replace('/&#039;/', "'", $str);
        return $str;
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
}