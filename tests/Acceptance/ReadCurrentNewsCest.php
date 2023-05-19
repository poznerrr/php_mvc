<?php


namespace Acceptance;

use Tests\Support\AcceptanceTester;

class ReadCurrentNewsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function GoThroughPageSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('2');
        $I->see('2', 'span');
        $I->see('1', 'a');
    }
}
