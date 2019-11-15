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

    private static $listWithProblems = [];
    private static $listWithoutProblems = [];

    public function saveResult($url, $error)
    {
        if ($error == 'OK')
            self::$listWithoutProblems["No problems with: \n\r"][] = $url;
        else
            self::$listWithProblems[$url][] = $error;
    }

    public function printResult()
    {
        $I = $this;

        $urlWithProblems = self::$listWithProblems;
        $urlWithoutProblems = self::$listWithoutProblems;

        $text = "";

        if (empty($urlWithProblems) && empty($urlWithoutProblems)) {
            $I->fail("UNEXPECTED ERROR: Something wrong with results. \n\r");
        } elseif (empty($urlWithProblems) && !empty($urlWithoutProblems)) {
            echo $output = "All changes were found." . "\r\n";
            $text = $text . $output;
        } elseif (!empty($urlWithProblems) && empty($urlWithoutProblems)) {
            echo $output = "No one change were found." . "\r\n";
            $text = $text . $output;
        } else {
            foreach ($urlWithoutProblems as $key => $value) {
                echo $output = "$key";
                $text = $text . $output;
                foreach ($value as $error) {
                    echo $output = "  - $error \n\r";
                    $text = $text . $output;
                }
            }
            echo $output = "\n\rSome URLs (" . count($urlWithProblems) . ") have problems: " . "\r\n";
            $text = $text . $output;
        }

        foreach ($urlWithProblems as $key => $value) {
            echo $output = "$key :" . "\n\r";
            $text = $text . $output;
            foreach ($value as $error) {
                echo $output = "  - $error \n\r";
                $text = $text . $output;
            }
        }
        $this->createFileReport('tests/_output/CeoReport.txt', $text);
        $I->assertEmpty(count($urlWithProblems), "Some URLs have problems with CEO");
    }

    private function createFileReport($name, $text)
    {
            file_put_contents($name, $text);
            echo "New report was created in $name\n\r";
    }
}
