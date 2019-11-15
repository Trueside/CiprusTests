<?php

namespace Page\Acceptance;

class YandexVideo
{
    // include url of current page
    public static $URL = '/video';
    public static $inputSearchVideo = 'span.input__clear ~ input';
    public static $buttonSearch = 'button[type="submit"]';
    public static $secondVideoBlock = 'div.serp-item:nth-child(2)';
    public static $hovered = 'div.thumb-image_hovered';
    public static $preview = 'div.thumb-preview__target_playing';
    public static $trailer = 'video.thumb-preview__video';

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
        return static::$URL . $param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

}
