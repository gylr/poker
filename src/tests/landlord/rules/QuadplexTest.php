<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Quadplex;
use PHPUnit\Framework\TestCase;

class QuadplexTest extends TestCase
{
    public function testAttachPair()
    {
        $numbers = [1,2,3,4,9,10];
        $obj = new Quadplex($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('q', $obj->getLabel(), '该规则标签为q');
        $this->assertFalse($obj->is(), '该序列is()返回false');
    }

    public function testRightOne()
    {
        $numbers = [1,2,3,4,9,13];
        $obj = new Quadplex($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('q', $obj->getLabel(), '该规则标签为q');
        $this->assertTrue($obj->is(), '该序列is()返回true');
    }

    public function testJokers()
    {
        $numbers = [1,2,3,4,53,54];
        $obj = new Quadplex($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('q', $obj->getLabel(), '该规则标签为q');
        $this->assertFalse($obj->is(), '该序列is()返回true');
    }

    public function testNumberTwo()
    {
        $numbers = [1,2,3,4,51,52];
        $obj = new Quadplex($numbers);
        $this->assertEquals(6, $obj->getCount(), '纸牌张数为6');
        $this->assertEquals('q', $obj->getLabel(), '该规则标签为q');
        $this->assertFalse($obj->is(), '双王执行is()返回false');
    }
}