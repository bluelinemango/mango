<?php
class ClientTests extends PHPUnit_Framework_TestCase {

    /**
     * @var \RemoteWebDriver
     */
    protected $webDriver;

	public function setUp()
    {
        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    //protected $url = 'https://github.com';
    protected $url = 'http://104.236.255.179/mango/public/user/login';

    public function login() {
        $this->webDriver->get($this->url);
        // checking that page title contains word 'GitHub'
        //$search = $this->webDriver->findElement(WebDriverBy::id('js-command-bar-field'));
        $search = $this->webDriver->findElement(WebDriverBy::id('emailInput'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('09364991494@yahoo.com');
        $search = $this->webDriver->findElement(WebDriverBy::id('passwordInput'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('123456');
        $search = $this->webDriver->findElement(WebDriverBy::id('loginButton'));
        $search->click();
    }
    
    public function notestGitHubHome1() {
        $this->login();
        $this->webDriver->quit();
    }
    
    public function testAddingAClient()
    {
        
        $this->login();
    
        
        $search = $this->webDriver->findElement(WebDriverBy::id('hamburgerIcon'));
        $search->click();

        
        //wait at most 10 seconds until you see the topClientsLink

        $this->webDriver->wait(20)->until(
          //presenceOfElementLocated is there too, but use it when it makes sense
          WebDriverExpectedCondition::visibilityOfElementLocated(
            WebDriverBy::id('topClientsLink')
          )
        );

        $search = $this->webDriver->findElement(WebDriverBy::id('topClientsLink'));
        $search->click();


        $search = $this->webDriver->findElement(WebDriverBy::id('AddClientButtonInTopClient'));
        $search->click();

        $search = $this->webDriver->findElement(WebDriverBy::id('name'));
        $search->click();       
        $this->webDriver->getKeyboard()->sendKeys('mtahmoud client test - ' + rand(1, 1000000000));
        
        $search = $this->webDriver->findElement(WebDriverBy::id('status'));
        $search->click();


        $search = $this->webDriver->findElement(WebDriverBy::id('save'));
        $search->click();

       // $search = $this->webDriver->findElement(WebDriverBy::id('topClientsMenuItem'));
       // $search->click();
    
        //  $this->assertContains('GitHub', $this->webDriver->getTitle());
        
         $this->webDriver->quit();
    }    

}
?>
