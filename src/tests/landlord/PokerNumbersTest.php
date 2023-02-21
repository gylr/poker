<?php
declare(strict_types=1);
namespace Lai\Poker\tests\landlord;

use Lai\Poker\landlord\PokerNumbers;
use PHPUnit\Framework\TestCase;

class PokerNumbersTest extends TestCase
{
    public function testDeskCards()
    {
        $poker = PokerNumbers::create();
        $this->assertContains(50, $poker->getNumbers(), '一副牌种含有数字编号50');
        $this->assertCount(54, $poker->getNumbers(), '一副牌总张数为54');
    }

    public function testSomeCards()
    {
        $numbers = [1,2,3,4,5];
        $poker = PokerNumbers::create($numbers);
        $this->assertContains(5, $poker->getNumbers(), '一副牌种含有数字编号5');
        $this->assertCount(5, $poker->getNumbers(), '这手牌总张数为5');
    }

    public function testFirst()
    {
        $first = PokerNumbers::create()->shuffle()->handOut()->getFirst();
        $this->assertCount(17, $first, '位序0的牌有17张');
    }

    public function testGetTrumps()
    {
        $trumps = PokerNumbers::create()->shuffle()->getTrumps();
        $this->assertCount(20, $trumps, '地主牌有20张');
    }

    public function testNumbersRange()
    {
        $numbers = PokerNumbers::create()->shuffle()->getNumbers();
        $this->assertGreaterThanOrEqual(1, min($numbers), '牌编号不可小于1');
        $this->assertLessThanOrEqual(54, max($numbers), '牌编号不可大于54');
    }
}