<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Bomb;
use PHPUnit\Framework\TestCase;

class BombTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,4];
        $bomb = new Bomb($numbers);
        $this->assertEquals(4, $bomb->getCount(), '纸牌张数为4');
        $this->assertEquals('b', $bomb->getLabel(), '该规则标签为b');
        $this->assertTrue($bomb->is(), 'is()返回true');
    }

    public function testOther()
    {
        $numbers = [1,2,5,6];
        $bomb = new Bomb($numbers);
        $this->assertEquals(4, $bomb->getCount(), '纸牌张数为4');
        $this->assertEquals('b', $bomb->getLabel(), '该规则标签为b');
        $this->assertFalse($bomb->is(), 'is()返回false');
    }

    public function testJokers()
    {
        $numbers = [1,2,53,54];
        $bomb = new Bomb($numbers);
        $this->assertEquals(4, $bomb->getCount(), '纸牌张数为4');
        $this->assertEquals('b', $bomb->getLabel(), '该规则标签为b');
        $this->assertFalse($bomb->is(), '双王执行is()返回false');
    }
}