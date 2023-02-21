<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\SequencePair;
use PHPUnit\Framework\TestCase;

class SequencePairTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,5,6,9,10];
        $obj = new SequencePair($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('sp', $obj->getLabel(), '该规则标签为sp');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testJokers()
    {
        $numbers = [1,2,5,6,53,54];
        $obj = new SequencePair($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('sp', $obj->getLabel(), '该规则标签为sp');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }

    public function testNumberTwo()
    {
        $numbers = [1,2,5,6,51,52];
        $obj = new SequencePair($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('sp', $obj->getLabel(), '该规则标签为sp');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }

    public function testRightOne()
    {
        $numbers = [21,22,25,26,29,30];
        $obj = new SequencePair($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('sp', $obj->getLabel(), '该规则标签为sp');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testShort()
    {
        $numbers = [21,22,25,26];
        $obj = new SequencePair($numbers);
        $this->assertEquals(4, $obj->getCount(), '纸牌张数为4');
        $this->assertEquals('sp', $obj->getLabel(), '该规则标签为sp');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testRepeat()
    {
        $numbers = [1,2,3,4,7,8];
        $obj = new SequencePair($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('sp', $obj->getLabel(), '该规则标签为sp');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }
}