<?php
declare(strict_types=1);
namespace Lai\Poker\tests\landlord;

use Lai\Poker\landlord\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testNumberOne()
    {
        $number = 1;
        $card = Card::create($number);
        $this->assertEquals(1, $card->getNumber(),'纸牌号'.$number.'的号码当为1');
        $this->assertEquals('3', $card->getPoint(),'纸牌号'.$number.'的点数当为3');
        $this->assertEquals(1, $card->getLevel(),'纸牌号'.$number.'的层级当为1');
        $this->assertEquals('S', $card->getDecor(),'纸牌号'.$number.'的牌色当为S');
    }

    public function testNumberFiftyTwo()
    {
        $number = 52;
        $card = Card::create($number);
        $this->assertEquals(52, $card->getNumber(),'纸牌号'.$number.'的号码当为52');
        $this->assertEquals('2', $card->getPoint(),'纸牌号'.$number.'的点数当为2');
        $this->assertEquals(13, $card->getLevel(),'纸牌号'.$number.'的层级当为13');
        $this->assertEquals('C', $card->getDecor(),'纸牌号'.$number.'的牌色当为C');
    }

    public function testNumberBlockJoker()
    {
        $number = 53;
        $card = Card::create($number);
        $this->assertEquals(53, $card->getNumber(),'纸牌号'.$number.'的号码当为53');
        $this->assertEquals('BJ', $card->getPoint(),'纸牌号'.$number.'的点数当为BJ');
        $this->assertEquals(14, $card->getLevel(),'纸牌号'.$number.'的层级当为14');
        $this->assertEquals('JOKER', $card->getDecor(),'纸牌号'.$number.'的牌色当为JOKER');
    }

    public function testNumberRedJoker()
    {
        $number = 54;
        $card = Card::create($number);
        $this->assertEquals(54, $card->getNumber(),'纸牌号'.$number.'的号码当为54');
        $this->assertEquals('RJ', $card->getPoint(),'纸牌号'.$number.'的点数当为RJ');
        $this->assertEquals(15, $card->getLevel(),'纸牌号'.$number.'的层级当为15');
        $this->assertEquals('JOKER', $card->getDecor(),'纸牌号'.$number.'的牌色当为JOKER');
    }
}