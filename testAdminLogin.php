<?php
require_once 'vendor/autoload.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testAdminLogin
 *
 * @author linhnp
 */
class testAdminLogin extends PHPUnit_Extensions_Selenium2TestCase {

    protected function setUp()
    {
        $this->setHost('localhost');
        $this->setPort(4444);
        
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://choxe.otofun.net:6002/admin');
    }

    public function testTitle()
    {
        $this->url('http://choxe.otofun.net:6002/admin/login');
        $this->assertEquals('Admin | Log in', $this->title());
    }

    public function testHasLoginForm()
    {
        $this->url('http://choxe.otofun.net:6002/admin/login');
        $username = $this->byName('email');
        $password = $this->byName('password');
        
        $this->assertEquals('', $username->value());
        $this->assertEquals('', $password->value());
    }
    
    public function testDoLoginSuccess()
    {
        $this->url('http://choxe.otofun.net:6002/admin/login');
        $this->byName('email')->value('philinh2003@hotmail.com');
        $this->byName('password')->value('philinh@123456');
        $this->clickOnElement('submit');
        
        $this->url('http://choxe.otofun.net:6002/admin');
        $dashboard = $this->byCssSelector('h1')->text();
        $this->assertRegExp('/Dashboard/i', $dashboard);
    }

}
