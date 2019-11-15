<?php

class CheckTrailerCest
{
    public function _before(AcceptanceTester $I, \Page\Acceptance\YandexVideo $yandexVideoPage)
    {
        $I->amOnPage($yandexVideoPage::$URL);
        $I->waitForElement($yandexVideoPage::$inputSearchVideo, 3);
    }

    // tests

    /**
     * @dataProvider pageProvider
     */
    public function tryToTest(AcceptanceTester $I, \Page\Acceptance\YandexVideo $yandexVideoPage, \Codeception\Example $example, PhpTester $P)
    {
        $I->wantTo("check a trailer of any video on Yandex.Video site");
        $I->fillField($yandexVideoPage::$inputSearchVideo, $example['videoName']);
        $I->click($yandexVideoPage::$buttonSearch);

        $I->waitForElement($yandexVideoPage::$secondVideoBlock, 2);
        $I->makeScreenshot("CheckTrailer_". $example['videoName']."_1before_" . date("d_m_H_i_s") . "_");
        $I->moveMouseOver($yandexVideoPage::$secondVideoBlock);
        $I->wait(1);
        $I->makeScreenshot("CheckTrailer_". $example['videoName']."_2after_" . date("d_m_H_i_s") . "_");

        $I->waitForElement($yandexVideoPage::$hovered, 2);
        $I->waitForElement($yandexVideoPage::$preview, 2);
        $I->seeElementInDOM($yandexVideoPage::$trailer);

        $linkOnVideo = $I->grabAttributeFrom($yandexVideoPage::$trailer, 'src');
        $P->sendGET($linkOnVideo);
        $P->seeResponseCodeIsSuccessful();
    }

    public function _createFileReport($name, $text)
    {
        file_put_contents($name, $text);
        echo "New report was created in $name\n\r";
    }

    /**
     * @return array
     */
    protected function pageProvider()
    {
        return [
            [
                'videoName' => "Ураган",

            ],
            [
                'videoName' => "Начало"
            ]
        ];
    }
}
