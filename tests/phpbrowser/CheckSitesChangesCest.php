<?php

class CheckSitesChangesCest
{
    public
    function _before(PhpTester $I)
    {
        $I->wantTo("check CEO's changes on sites");
    }

    // tests
    public function tryToTest(PhpTester $I, \Page\Phpbrowser\CEO $ceoPage)
    {
        if (($handle = fopen($ceoPage::$pathToCsvFile, "r")) !== FALSE) {
            $url = null;
            $title = null;
            $description = null;

            while (($table = fgetcsv($handle, 1000)) !== FALSE) {

                $numCell = 0;

                while (is_null($url) || is_null($title) || is_null($description)) {
                    switch ($table[$numCell]) {
                        case "URL":
                            $url = $numCell;
                            $numCell++;
                            break;
                        case "Title":
                            $title = $numCell;
                            $numCell++;
                            break;
                        case "Description":
                            $description = $numCell;
                            $numCell++;
                            break;
                        default:
                            echo "Never run \n";
                            $numCell++;
                            break;
                    }
                }

                if ($table[$url] == "URL")
                    continue;

                $problems = 0;
                $I->setCookie($ceoPage::$cookieName, $ceoPage::$cookieValue);

                $I->amOnUrl($table[$url]);

                try {
                    $I->seeElement($ceoPage::$selectorTitle . $table[$title] . "')]");
                } catch (\Throwable $ex) {
                    $error = "The new title was not found";
                    $I->setError($table[$url], $error);
                    $problems++;
                }

                if ($fes = $I->grabAttributeFrom($ceoPage::$selectorDescription, $ceoPage::$descriptionAtribute) != $table[$description]) {
                    $error = "The new description was not found";
                    $I->setError($table[$url], $error);
                    $problems++;
                }

                if ($problems == 0)
                    echo $table[$url] . " don't have problems with CEO! \r\n";
            }
            fclose($handle);
            $I->printError();
        }
    }
}
