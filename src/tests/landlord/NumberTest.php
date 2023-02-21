<?php
declare(strict_types=1);
namespace Lai\Poker\tests\landlord;

use Lai\Poker\landlord\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testFilterData()
    {
        $numbers = [1,2,3,4,5,5,3];
        $data = Number::create($numbers)->filter()->get();
        $this->assertIsArray($data, '结果集为数组');
        $this->assertCount(5, $data, '结果集的元素只有5个');

        $numbers = '31,32,33,33';
        $data = Number::create($numbers)->filter()->get();
        $this->assertIsArray($data, '结果集为数组');
        $this->assertCount(3, $data, '结果集的元素只有3个');
    }

    public function testToString()
    {
        $numbers = [1,2,3,4,5];
        $string = Number::create($numbers)->filter()->toString();
        $this->assertEquals('1,2,3,4,5', $string, '数据格式化后的结果字符串');
        $this->assertStringContainsString(',', $string, '数据格式化后的结果应为‘,’分割');

        $number_string = '1,2,3,4,5';
        $string = Number::create($number_string)->filter()->toString();
        $this->assertEquals('1,2,3,4,5', $string, '数据格式化后的结果字符串');
        $this->assertStringContainsString(',', $string, '数据格式化后的结果应为‘,’分割');
    }
}