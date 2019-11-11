<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class PhpTester extends \Codeception\Actor
{
    use _generated\PhpTesterActions;

   /**
    * Define custom actions here
    */

    private static $listOfErrors;

    public function setError($url, $error)
    {
        self::$listOfErrors[$url][] = $error;
    }

    public function printError()
    {
        $I = $this;
        $urlWithPrblems = self::$listOfErrors;

        if (empty($urlWithPrblems)) {
            echo "\n\r" . date("d.m H:i:s") . " - Every changes were found." . "\r\n";
        } else {
            echo "Some URLs (" . count($urlWithPrblems) . ") have problems:" . "\r\n";
            foreach ($urlWithPrblems as $key => $value) {
                foreach ($value as $error) {
                    echo " $key - $error \n\r";
                }
            }
            $I->assertEquals(count($urlWithPrblems), 0, "Some URLs have problems with CEO");
        }
    }
}
