<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord;

use lai\poker\landlord\ChainsLabel;
use lai\poker\landlord\rules\Bomb;
use lai\poker\landlord\rules\None;
use lai\poker\landlord\rules\Pair;
use lai\poker\landlord\rules\Quadplex;
use lai\poker\landlord\rules\QuadplexPairs;
use lai\poker\landlord\rules\Rocket;
use lai\poker\landlord\rules\Sequence;
use lai\poker\landlord\rules\SequencePair;
use lai\poker\landlord\rules\SequenceTripletWithOne;
use lai\poker\landlord\rules\SequenceTripletWithPair;
use lai\poker\landlord\rules\Single;
use lai\poker\landlord\rules\Triplet;
use lai\poker\landlord\rules\TripletWithOne;
use lai\poker\landlord\rules\TripletWithPair;
use PHPUnit\Framework\TestCase;

class ChainsLabelTest extends TestCase
{
    public function testSingle()
    {
        $label = 's';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Single::class, $class,'当为Single实例');
    }

    public function testPair()
    {
        $label = 'p';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Pair::class, $class,'当为Pair实例');
    }

    public function testBomb()
    {
        $label = 'b';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Bomb::class, $class,'当为Bomb实例');
    }

    public function testTriplet()
    {
        $label = 't';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Triplet::class, $class,'当为Triplet实例');
    }

    public function testRocket()
    {
        $label = 'r';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Rocket::class, $class,'当为Rocket实例');
    }

    public function testSequence()
    {
        $label = 'ss';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Sequence::class, $class,'当为Sequence实例');
    }

    public function testSequencePair()
    {
        $label = 'sp';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(SequencePair::class, $class,'当为SequencePair实例');
    }

    public function testSequenceTripletWithOne()
    {
        $label = 'sto';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(SequenceTripletWithOne::class, $class,'当为SequenceTripletWithOne实例');
    }

    public function testSequenceTripletWithPair()
    {
        $label = 'stp';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(SequenceTripletWithPair::class, $class,'当为SequenceTripletWithPair实例');
    }

    public function testTripletWithOne()
    {
        $label = 'to';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(TripletWithOne::class, $class,'当为TripletWithOne实例');
    }

    public function testTripletWithPair()
    {
        $label = 'tp';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(TripletWithPair::class, $class,'当为TripletWithPair实例');
    }

    public function testQuadplex()
    {
        $label = 'q';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(Quadplex::class, $class,'当为Quadplex实例');
    }

    public function testQuadplexPairs()
    {
        $label = 'qp';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(QuadplexPairs::class, $class,'当为QuadplexPairs实例');
    }

    public function testNone()
    {
        $label = 'no';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');

        $label = 'other';
        $class = ChainsLabel::create($label)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

}