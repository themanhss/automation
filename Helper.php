<?php

/**
 * Description of Helper
 *
 * @author linhnp
 */
class Helper {
    public function __construct()
    {
        
    }
    
    public function curlProcess($url, $params=null, $method=null)
    {
        //var_dump($params);die;
        //var_dump($url);die;
        //  Initiate curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        
        if(in_array(strtolower($method), ['put', 'delete'])){
            //die('Process Method put | delete');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        }
        
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        // Execute
        $result = curl_exec($ch);

        $result = json_decode($result);
        curl_close($ch);

        return $result;
    }
    
}
