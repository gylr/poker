<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\SequenceTriplet;
use PHPUnit\Framework\TestCase;

class SequenceTripletTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,4,5,6];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testJokers()
    {
        $numbers = [1,2,3,52,53,54];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }

    public function testRightOne()
    {
        $numbers = [1,2,3,5,6,7];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testShort()
    {
        $numbers = [13,14,15,18,19];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(5, $obj->getCount(), '纸牌张数为5');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testRepeat()
    {
        $numbers = [1,2,3,4,5,6,7];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(7, $obj->getCount(), '纸牌张数为7');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testMoreJump()
    {
        $numbers = [1,2,3,9,10,11];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testJustOne()
    {
        $numbers = [49,50,52];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(3, $obj->getCount(), '纸牌张数为3');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testContainNumberTwo()
    {
        $numbers = [45,46,17,49,50,52];
        $obj = new SequenceTriplet($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('st', $obj->getLabel(), '该规则标签为st');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }
}