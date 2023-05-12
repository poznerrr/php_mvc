<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class UriMakerTest extends TestCase
{

    private \Source\App\UriMaker $uriMaker;

    //setUp - метода на выполнение перед тестом
    protected function setUp(): void
    {
        $this->uriMaker = \Source\App\UriMaker::getInstance();
    }

    //tearDown - метод на ввыполение после теста
    protected function tearDown(): void
    {

    }

    public function testTranslite()
    {
        $this->assertEquals('basketbol', $this->uriMaker->urlRuEnTranslite('баскетбол'));
    }


}