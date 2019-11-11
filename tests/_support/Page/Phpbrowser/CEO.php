<?php
namespace Page\Phpbrowser;

class CEO
{
    // include url of current page
    public static $pathToCsvFile = 'tests\_data\CeoExample.csv';
    public static $cookieName = 'test';
    public static $cookieValue = 'ceo';
    public static $selectorTitle = ".//title[contains(text(),'";
    public static $selectorDescription = 'meta[name="description"]';
    public static $descriptionAtribute = 'content';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @var \PhpTester;
     */
    protected $phpTester;

    public function __construct(\PhpTester $I)
    {
        $this->phpTester = $I;
    }

}
