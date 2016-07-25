<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testPostAPI
 *
 * @author linhnp
 */
class testPostAPI extends PHPUnit_Framework_TestCase {

    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    
    protected $__access_token;
    protected $__base_url;

    public function setUp()
    {
//        $this->__base_url = 'http://choxe.otofun.net:6002/api/';
//        $this->__access_token = '3f97dd9835289892c84ed616fc67159d5cb73e11a22bd69b8ac90f14a8d6bd27';
        
        $this->__base_url = 'http://otv.development/api/';
        $this->__access_token = '841379e16769513eaba3bd26a44e3f3c94ce79c4867186bced1ef267bebb266c';
    }
    
    public function testAddPost()
    {
        $params = [
            "product_type"=>1,
            "manufacturer_id"=>"108",
            "category_id"=>"363",
            "production_year"=>"2016",
            "style_id"=>"6",
            "product_status"=>"1",
            "km_traveled"=>"2",
            "city_id"=>"54",
            "color"=>"Trắng",
            "price"=>1000000000,
            "gear_id"=>"1",
            "door"=>"4",
            "fuel"=>"Xăng",
            "engine_capacity"=>"2.0",
            "dd_style"=>"Cầu trước",
            "year_register_first"=>"2016",
            "content"=>"Cần bán xe này",
            "user_id"=>1,
            "formType"=>"add",
            "postType"=>"sale",
            "arrImages"=>[
                ["position"=>"1","name"=>"b011060f23820a83cac7393ffe9d81844328e3e0230a9e8670fd2722e497c318.jpg"],
                ["position"=>"2","name"=>"7f178513dd3ec7159c877cd86ae5a71de9a00dea31fc5ed785c0cbf7da252a6f.jpg"],
                ["position"=>"3","name"=>"f77fb11f50fd0b4a641eb271dee9b80bdedfa2bbe3c1afabcb20531a63151496.jpg"],
                ["position"=>"4","name"=>"002ed94345c099fe5dd30837c4fb6263894807b59311e9810da2555aa4ebab8f.jpg"],
                ["position"=>"5","name"=>"f017dc8f99ade6decdd39bfb28404ccee1b083cd7c1b00cde2cca61ef1dc402b.jpg"]
            ],
            "contact_name"=>"Đạt Béo",
            "contact_address"=>"Hoàng Mai",
            "contact_phone"=>"0987098045" 
        ];
        
        $params = http_build_query($params);
        
        $url = $this->__base_url . 'post/add?access_token=' . $this->__access_token;
        $rs = $this->curlProcess($url, $params);
        var_dump(gettype($rs), $rs);
        $this->assertNotEmpty($rs->post->unique_code);
    }
    
    public function tearDown()
    {
        
    }
    
    protected function curlProcess($url, $params=null)
    {
        //var_dump($url);die;
        //  Initiate curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);

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
