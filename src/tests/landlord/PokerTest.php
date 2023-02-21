<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord;

use lai\poker\landlord\Card;
use lai\poker\landlord\Poker;
use PHPUnit\Framework\TestCase;

class PokerTest extends TestCase
{
    public function testNumberOne()
    {
        $numbers = [1];
        $data = Poker::create($numbers)->handle()->getData();
        $this->assertCount(1, $data, '数组元素总量为1');
        $array = Card::create(1)->toArray();
        $this->assertSame(array_diff($data[0], $array), array_diff($array, $data[0]), '数组结果集不一致');
    }
}