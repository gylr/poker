<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\Rocket;
use PHPUnit\Framework\TestCase;

class RocketTest extends TestCase
{
    public function testOne()
    {
        $numbers = [1,2];
        $rocket = new Rocket($numbers);
        $this->assertEquals(2, $rocket->getCount(), '纸牌张数为2');
        $this->assertEquals('r', $rocket->getLabel(), '该规则标签为r');
        $this->assertFalse($rocket->is(), '非双王is()返回false');
    }

    public function testOther()
    {
        $numbers = [1,54];
        $rocket = new Rocket($numbers);
        $this->assertEquals(2, $rocket->getCount(), '纸牌张数为2');
        $this->assertEquals('r', $rocket->getLabel(), '该规则标签为r');
        $this->assertFalse($rocket->is(), 'is()返回false');
    }

    public function testJokers()
    {
        $numbers = [53,54];
        $rocket = new Rocket($numbers);
        $this->assertEquals(2, $rocket->getCount(), '纸牌张数为2');
        $this->assertEquals('r', $rocket->getLabel(), '该规则标签为r');
        $this->assertTrue($rocket->is(), '双王执行is()返回true');
    }
}