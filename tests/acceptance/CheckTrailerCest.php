<?php

class CheckTrailerCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->wantTo("check a trailer of any video on Yandex.Video");
    }

    // tests
    public function tryToTest(AcceptanceTester $I,  \Page\Acceptance\YandexVideo $yandexVideoPage)
    {
        $I->amOnPage($yandexVideoPage::$URL);
        $I->waitForElement($yandexVideoPage::$inputSearchVideo,2 );
        $I->fillField($yandexVideoPage::$inputSearchVideo, $yandexVideoPage::$nameOfVideo);
        $I->click($yandexVideoPage::$buttonSearch);

        // столкнулся с проблемой бесконечного прелоадера при загрузке результатов поиска
        $I->reloadPage(); // самое простое решение проблемы бессконечного прелоадера

        $I->waitForElement($yandexVideoPage::$secondVideoBlock,2);
        $I->moveMouseOver($yandexVideoPage::$secondVideoBlock);
        $I->waitForElement($yandexVideoPage::$trailer,2);
        $I->seeElementInDOM($yandexVideoPage::$trailer);
    }
}
