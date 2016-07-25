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
class testGooglePlusWebDriver extends PHPUnit_Framework_TestCase {

    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    

    public function setUp()
    {
        
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::firefox());
        
    }
    
    public function tearDown()
    {
        // $this->webDriver->quit();
    }
    
    public function testHasForm()
    {
            $this->webDriver->get('https://plus.google.com/share?url=http://phaser.io/examples/v2/text/text-tabs');

            $email = $this->webDriver->findElement(WebDriverBy::id('Email'));
            $email->sendKeys('themanhss');
            
            $submit = $this->webDriver->findElement(WebDriverBy::id('next'));
            $submit->click();

            $this->webDriver->wait(10);

            $password = $this->webDriver->findElement(WebDriverBy::id('Passwd'));
            $password->sendKeys('philinh@123456');
            
    }
    

}
