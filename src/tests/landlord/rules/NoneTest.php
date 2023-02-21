<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord\rules;

use lai\poker\landlord\rules\None;
use PHPUnit\Framework\TestCase;

class NoneTest extends TestCase
{
    public function testOne()
    {
        $none = new None();
        $this->assertEquals(0, $none->getCount(), '纸牌张数为0');
        $this->assertEquals('no', $none->getLabel(), '该规则标签为no');
        $this->assertTrue($none->is(), 'is()返回true');
    }
}