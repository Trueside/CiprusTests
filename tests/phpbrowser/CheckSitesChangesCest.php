<?php
/**
 * @group ceo
 * @group phpbrowser
 */

class CheckSitesChangesCest
{
    public function _before(PhpTester $I)
    {
    }

    public function _after(PhpTester $I)
    {
        $I->printResult();
    }

    // tests
    public function tryToTest(PhpTester $I, \Page\Phpbrowser\CEO $ceoPage)
    {
        $I->wantTo("check CEO's changes on sites");

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
                            $I->fail("UNEXPECTED ERROR: This code never run \n");
                    }
                }

                if ($table[$url] == "URL")
                    continue;

                try {
                    $I->amOnUrl($table[$url]);
                    $I->seeResponseCodeIsSuccessful();
                } catch (\Throwable $ex) {
                    $I->saveResult($table[$url], $ex->getMessage());
                    continue;
                }

                $I->setCookie($ceoPage::$cookieName, $ceoPage::$cookieValue);

                try {
                    $I->seeElement($ceoPage::$selectorTitle . $table[$title] . "')]");
                } catch (\Throwable $ex) {
                    $I->saveResult($table[$url], "The new title was not found " . "[$table[$title]].");
                }

                try {
                    $realDescription = $I->grabAttributeFrom($ceoPage::$selectorDescription, $ceoPage::$descriptionAtribute);
                } catch (\Throwable $ex) {
                    $I->saveResult($table[$url], $ex->getMessage());
                    continue;
                }

                if ($realDescription != $table[$description]) {
                    $I->saveResult($table[$url], "The new description was not found " . "[$table[$description]].");
                    continue;
                }
                $I->saveResult($table[$url], 'OK');
            }
            fclose($handle);
        }
    }
}
