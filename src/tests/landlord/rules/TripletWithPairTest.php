<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\TripletWithPair;
use PHPUnit\Framework\TestCase;

class TripletWithPairTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,5,6];
        $obj = new TripletWithPair($numbers);
        $this->assertEquals(5, $obj->getCount(), '纸牌张数为5');
        $this->assertEquals('tp', $obj->getLabel(), '该规则标签为tp');
        $this->assertTrue($obj->is(), 'is()返回true');
    }

    public function testOther()
    {
        $numbers = [5,6,9,53,52];
        $obj = new TripletWithPair($numbers);
        $this->assertEquals(5, $obj->getCount(), '纸牌张数为5');
        $this->assertEquals('tp', $obj->getLabel(), '该规则标签为tp');
        $this->assertFalse($obj->is(), 'is()返回false');
    }

    public function testJokers()
    {
        $numbers = [1,2,3,53,54];
        $obj = new TripletWithPair($numbers);
        $this->assertEquals(5, $obj->getCount(), '纸牌张数为5');
        $this->assertEquals('tp', $obj->getLabel(), '该规则标签为tp');
        $this->assertFalse($obj->is(), '有双王，is()返回false');
    }
}