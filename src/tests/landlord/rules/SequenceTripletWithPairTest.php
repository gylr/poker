<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\SequenceTripletWithPair;
use PHPUnit\Framework\TestCase;

class SequenceTripletWithPairTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,5,6,9,10,11,13,14];
        $obj = new SequenceTripletWithPair($numbers);
        $this->assertEquals(10, $obj->getCount(), '纸牌张数为10');
        $this->assertEquals('stp', $obj->getLabel(), '该规则标签为stp');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testRightOne()
    {
        $numbers = [1,2,3,5,6,7,9,10,13,14];
        $obj = new SequenceTripletWithPair($numbers);
        $this->assertEquals(10, $obj->getCount(), '纸牌张数为10');
        $this->assertEquals('stp', $obj->getLabel(), '该规则标签为stp');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testJokers()
    {
        $numbers = [1,2,3,5,6,7,53,54,47,48];
        $obj = new SequenceTripletWithPair($numbers);
        $this->assertEquals(10, $obj->getCount(), '纸牌张数为10');
        $this->assertEquals('stp', $obj->getLabel(), '该规则标签为stp');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }

    public function testShort()
    {
        $numbers = [1,2,3,5,6,7,9,10,13];
        $obj = new SequenceTripletWithPair($numbers);
        $this->assertEquals(9, $obj->getCount(), '纸牌张数为9');
        $this->assertEquals('stp', $obj->getLabel(), '该规则标签为stp');
        $this->assertFalse($obj->is(), '数量不够is()返回false');
    }

    public function testMore()
    {
        $numbers = [1,2,3,5,6,7,9,10,13,14,17];
        $obj = new SequenceTripletWithPair($numbers);
        $this->assertEquals(11, $obj->getCount(), '纸牌张数为11');
        $this->assertEquals('stp', $obj->getLabel(), '该规则标签为stp');
        $this->assertFalse($obj->is(), '数量太多is()返回false');
    }

    public function testRepeat()
    {
        $numbers = [1,2,3,5,6,7,9,10,13,14,15];
        $obj = new SequenceTripletWithPair($numbers);
        $this->assertEquals(11, $obj->getCount(), '纸牌张数为11');
        $this->assertEquals('stp', $obj->getLabel(), '该规则标签为stp');
        $this->assertFalse($obj->is(), '重复了，该序列is()返回false');
    }
}