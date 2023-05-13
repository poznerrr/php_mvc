<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    private \Source\Models\User $user;

    //setUp - метода на выполнение перед тестом
    protected function setUp(): void
    {
        $this->user = new \Source\Models\User(22, "Anton", '12345');

    }

    //tearDown - метод на ввыполение после теста
    protected function tearDown(): void
    {
        unset($this->user);
    }

    /**
     * @dataProvider nameProvider
     */
    public function testName($name)
    {
        $this->assertEquals($name, $this->user->getName());
    }

    public static function nameProvider(): array
    {
        return [
            'correct' => ['Anton'],
            'incorrect1' => ['anton'],
            'incorrect2' => ['Антон']
        ];
    }


}