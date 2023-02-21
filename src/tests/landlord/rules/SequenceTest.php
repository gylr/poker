<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Sequence;
use PHPUnit\Framework\TestCase;

class SequenceTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,4,5,6];
        $obj = new Sequence($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('ss', $obj->getLabel(), '该规则标签为ss');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testJokers()
    {
        $numbers = [1,2,3,4,53,54];
        $obj = new Sequence($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('ss', $obj->getLabel(), '该规则标签为ss');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }

    public function testRightOne()
    {
        $numbers = [1,5,9,13,17,21];
        $obj = new Sequence($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('ss', $obj->getLabel(), '该规则标签为ss');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testShort()
    {
        $numbers = [1,5,9,13];
        $obj = new Sequence($numbers);
        $this->assertEquals(4, $obj->getCount(), '纸牌张数为4');
        $this->assertEquals('ss', $obj->getLabel(), '该规则标签为ss');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testRepeat()
    {
        $numbers = [1,2,5,9,13,17];
        $obj = new Sequence($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('ss', $obj->getLabel(), '该规则标签为ss');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }
}