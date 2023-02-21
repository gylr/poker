<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Single;
use PHPUnit\Framework\TestCase;

class SingleTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1];
        $single = new Single($numbers);
        $this->assertEquals(1, $single->getCount(), '纸牌张数为1');
        $this->assertEquals('s', $single->getLabel(), '该规则标签为s');
        $this->assertTrue($single->is(), 'is()返回true');
    }

    public function testMoreNumber()
    {
        $numbers = [1,2];
        $single = new Single($numbers);
        $this->assertFalse($single->is(), 'is()返回false');
    }

    public function testOtherNumbers()
    {
        $numbers = [55,56];
        $single = new Single($numbers);
        $this->assertCount(0, $single->get(), '非法数据，应该返回0');
        $this->assertFalse($single->is(), 'is()返回false');
    }
}