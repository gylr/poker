<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord;

use lai\poker\landlord\Decor;
use PHPUnit\Framework\TestCase;

class DecorTest extends TestCase
{
    public function testGetAll()
    {
        $this->assertCount(4, Decor::getAll(), '应该为4种花色');
    }

    public function testGenerateOne()
    {
        $this->assertEquals('S', Decor::generateOne(1),'应该为S');
        $this->assertEquals('H', Decor::generateOne(2),'应该为H');
        $this->assertEquals('D', Decor::generateOne(3),'应该为D');
        $this->assertEquals('C', Decor::generateOne(4),'应该为C');

        $this->assertEquals('S', Decor::generateOne(49),'应该为S');
        $this->assertEquals('H', Decor::generateOne(50),'应该为H');
        $this->assertEquals('D', Decor::generateOne(51),'应该为D');
        $this->assertEquals('C', Decor::generateOne(52),'应该为C');
    }
}