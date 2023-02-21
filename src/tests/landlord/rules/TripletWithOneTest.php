<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\TripletWithOne;
use PHPUnit\Framework\TestCase;

class TripletWithOneTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,5];
        $obj = new TripletWithOne($numbers);
        $this->assertEquals(4, $obj->getCount(), '纸牌张数为4');
        $this->assertEquals('to', $obj->getLabel(), '该规则标签为to');
        $this->assertTrue($obj->is(), 'is()返回true');
    }

    public function testOther()
    {
        $numbers = [5,6,9,53];
        $obj = new TripletWithOne($numbers);
        $this->assertEquals(4, $obj->getCount(), '纸牌张数为4');
        $this->assertEquals('to', $obj->getLabel(), '该规则标签为to');
        $this->assertFalse($obj->is(), 'is()返回false');
    }

    public function testJoker()
    {
        $numbers = [1,2,53,54];
        $obj = new TripletWithOne($numbers);
        $this->assertEquals(4, $obj->getCount(), '纸牌张数为4');
        $this->assertEquals('to', $obj->getLabel(), '该规则标签为to');
        $this->assertFalse($obj->is(), '有双王，is()返回false');
    }
}