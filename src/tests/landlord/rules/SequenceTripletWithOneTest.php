<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\SequenceTripletWithOne;
use PHPUnit\Framework\TestCase;

class SequenceTripletWithOneTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2,3,20,5,6,7,25];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(8, $obj->getCount(), '纸牌张数为8');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testJoker()
    {
        $numbers = [1,2,3,51,5,6,7,54];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(8, $obj->getCount(), '纸牌张数为8');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertTrue($obj->is(), '有一个王执行is()返回true');
    }

    public function testJokers()
    {
        $numbers = [1,2,3,53,5,6,7,54];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(8, $obj->getCount(), '纸牌张数为8');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }

    public function testShort()
    {
        $numbers = [1,2,3,53,5,6,7];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(7, $obj->getCount(), '纸牌张数为7');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertFalse($obj->is(), '数量不够is()返回false');
    }

    public function testMore()
    {
        $numbers = [1,2,3,53,5,6,7,9,15];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(9, $obj->getCount(), '纸牌张数为9');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertFalse($obj->is(), '数量太多is()返回false');
    }

    public function testRepeat()
    {
        $numbers = [1,2,3,5,6,7,8,10];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(8, $obj->getCount(), '纸牌张数为8');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertFalse($obj->is(), '重复了，该序列is()返回false');
    }

    public function testBomb()
    {
        $numbers = [2,3,4,6,7,8,9,10,12,14,15,16,45,46,47,48];
        $obj = new SequenceTripletWithOne($numbers);
        $this->assertEquals(16, $obj->getCount(), '纸牌张数为16');
        $this->assertEquals('sto', $obj->getLabel(), '该规则标签为sto');
        $this->assertFalse($obj->is(), '数量太多is()返回false');
    }
}