<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Pair;
use PHPUnit\Framework\TestCase;

class PairTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2];
        $pair = new Pair($numbers);
        $this->assertEquals(2, $pair->getCount(), '纸牌张数为2');
        $this->assertEquals('p', $pair->getLabel(), '该规则标签为p');
        $this->assertTrue($pair->is(), 'is()返回true');
    }

    public function testOneFalse()
    {
        $numbers = [1,5];
        $pair = new Pair($numbers);
        $this->assertEquals(2, $pair->getCount(), '纸牌张数为2');
        $this->assertEquals('p', $pair->getLabel(), '该规则标签为p');
        $this->assertFalse($pair->is(), 'is()返回false');
    }

    public function testJoker()
    {
        $numbers = [53,54];
        $pair = new Pair($numbers);
        $this->assertEquals(2, $pair->getCount(), '纸牌张数为2');
        $this->assertEquals('p', $pair->getLabel(), '该规则标签为p');
        $this->assertFalse($pair->is(), '双王执行is()返回false');
    }
}