<?php

require_once 'vendor/autoload.php';

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

/**
 * Description of testAdminLogin
 *
 * @author linhnp
 */
class testAdminLoginWebDriver extends PHPUnit_Framework_TestCase {

    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    
    protected $__admin_url;

    public function setUp()
    {
        $config = require 'config.php';
        
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::firefox());
        
        $this->__admin_url = $config['local_admin_url'];
    }
    
    public function tearDown()
    {
        $this->webDriver->quit();
    }
    
    public function testHasLoginForm()
    {
        $this->webDriver->get($this->__admin_url . 'login');
        
        $username = $this->webDriver->findElement(WebDriverBy::id('email'));
        $usernameVal = $username->getText();
        
        $password = $this->webDriver->findElement(WebDriverBy::id('password'));
        $passwordVal = $password->getText();
        
        $this->assertEquals('', $usernameVal);
        $this->assertEquals('', $passwordVal);
    }
    
    public function testDoLoginSuccess()
    {
        $this->webDriver->get($this->__admin_url . 'login');
        
        $username = $this->webDriver->findElement(WebDriverBy::id('email'));
        $username->sendKeys('philinh2003@hotmail.com');
        
        $password = $this->webDriver->findElement(WebDriverBy::id('password'));
        $password->sendKeys('philinh@123456');
        
        $submit = $this->webDriver->findElement(WebDriverBy::id('submit'));
        $submit->click();
        
        $this->webDriver->wait();
        
        $this->webDriver->get($this->__admin_url);
        
        $dashboard = $this->webDriver->findElement(WebDriverBy::cssSelector('h1'))->getText();

        $this->assertRegExp('/Dashboard/i', $dashboard);
    }

}
