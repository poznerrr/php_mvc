<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/authorization');
        $I->fillField(['name' => 'user-name'], 'admin');
        $I->fillField(['name' => 'user-password'], '12345678');
        $I->click('form input[type=submit]');
        $I->see('Вы успешно авторизованы');
    }
}
