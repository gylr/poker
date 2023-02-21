<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Triplet;
use PHPUnit\Framework\TestCase;

class TripletTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3];
        $triplet = new Triplet($numbers);
        $this->assertEquals(3, $triplet->getCount(), '纸牌张数为2');
        $this->assertEquals('t', $triplet->getLabel(), '该规则标签为t');
        $this->assertTrue($triplet->is(), 'is()返回true');
    }

    public function testOneFalse()
    {
        $numbers = [1,2,5];
        $triplet = new Triplet($numbers);
        $this->assertEquals(3, $triplet->getCount(), '纸牌张数为3');
        $this->assertEquals('t', $triplet->getLabel(), '该规则标签为t');
        $this->assertFalse($triplet->is(), 'is()返回false');
    }

    public function testJoker()
    {
        $numbers = [53,54];
        $triplet = new Triplet($numbers);
        $this->assertEquals(2, $triplet->getCount(), '纸牌张数为2');
        $this->assertEquals('t', $triplet->getLabel(), '该规则标签为t');
        $this->assertFalse($triplet->is(), '双王执行is()返回false');
    }
}